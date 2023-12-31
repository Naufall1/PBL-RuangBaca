<?php
// include 'Readable.php';
include 'IFilter.php';
include 'ISearch.php';
include 'Book.php';
include 'Thesis.php';

// include 'Thesis.php';
class Catalog implements IFilter, ISearch
{
    private $readable;
    private int $max;
    private array $filters;

    function __construct(int $max)
    {
        $this->readable = array(
            'book' => new Book(),
            'thesis' => new Thesis(),
        );
        $this->filters = array();
        $this->max = $max;
    }

    public function filter($args)
    {
        $queryTemplate = array(
            'location' => ' shelf_id IN (',
            'category' => ' category_id IN (',
            'author' => ' author_id IN (',
            'publisher' => ' publisher_id IN (',
            'year' => ' year_published IN (',
            'prodi' => ' category IN ('
        );
        $query = '';
        if (isset($args['type'])) {
            $this->filters['jenis'] = $args['type'];
        }
        if (isset($args['avail-status'])) {
            if ($args['avail-status'][0] == "avail") {
                $query = $query . 'avail > 0 ';
            } else {
                $query = $query . 'avail = 0 ';
            }
            $this->filters['ketersediaan'] = $query;
        }

        foreach ($args as $arg => $value) {
            if (isset($args[$arg]) && $arg != 'avail-status' && $arg != 'type') {
                $queryFilter = $queryTemplate[$arg];
                foreach ($args[$arg] as $key => $value) {
                    $value = Database::sanitizeInput($value);
                    $queryFilter = $queryFilter . '"' . $value . '"';
                    if (count($args[$arg]) > 1 && $key != count($args[$arg]) - 1) {
                        $queryFilter = $queryFilter . ', ';
                    }
                }
                $queryFilter = $queryFilter . ')';
                // var_dump($queryFilter);
                $this->filters[$arg] = $queryFilter;
            }
        }
        $_SESSION['filters'] = $this->filters;
    }
    public function search($query): array
    {
        return $this->getContent($_SESSION['page'], $_SESSION['sort'], $query);
    }
    public function getContent(int $page, string $sort = 'default', string $search = null): array
    {
        $content = array();
        try {
            $queryUnion = 'UNION';
            $query = '';
            $queryBook = 'SELECT book_id as id, book_title as title, year_published as year FROM book';
            $queryThesis = 'SELECT thesis_id as id, thesis_title as title, year_published as year FROM thesis';

            $start = ($page * $this->max) - $this->max;
            $_SESSION['start'] = $start;
            $limit = $this->max;

            if (!isset($_SESSION['filters'])) {
                $_SESSION['filters'] = array();
            }

            if (count($_SESSION['filters']) > 0 && !(isset($_SESSION['filters']['jenis']) && count($_SESSION['filters']) == 1)) {
                $queryBook = $queryBook . ' WHERE ';
                $queryThesis = $queryThesis . ' WHERE ';
            }

            $i = 0;
            foreach ($_SESSION['filters'] as $key => $value) {
                if ((isset($_SESSION['filters']['jenis']) && $_SESSION['filters']['jenis'][0] == 'skripsi') || isset($_SESSION['filters']['prodi'])) {
                    # code...
                    $queryUnion = str_replace('UNION', '', $queryUnion);
                    $queryBook = '';
                } else {
                    if ($key != 'jenis') {
                        $queryBook = $queryBook . $value;
                        if (count($_SESSION['filters']) > 1 && $i != count($_SESSION['filters']) - 1) {
                            $queryBook = $queryBook . ' AND';
                        }
                    }
                    $i++;
                }
            }

            $i = 0;
            foreach ($_SESSION['filters'] as $key => $value) {
                if ($key == 'category' || $key == 'author' || $key == 'publisher') {
                    $queryThesis = '';
                    $queryUnion = str_replace('UNION', '', $queryUnion);
                    break;
                }

                if (isset($_SESSION['filters']['jenis']) && $_SESSION['filters']['jenis'][0] == 'buku') {
                    $queryUnion = str_replace('UNION', '', $queryUnion);
                    $queryThesis = '';
                } else {
                    if ($key != 'jenis') {
                        $queryThesis = $queryThesis . $value;
                        if (count($_SESSION['filters']) > 1 && $i != count($_SESSION['filters']) - 1) {
                            $queryThesis = $queryThesis . ' AND';
                        }
                    }
                    $i++;
                }
            }
            $querySearch = Database::sanitizeInput($search);
            if (empty($querySearch) && isset($_SESSION['querySearch'])) {
                $querySearch = $_SESSION['querySearch'];
            } else {
                $_SESSION['querySearch'] = $querySearch;
            }
            if (!is_null($querySearch)) {
                if (isset($_SESSION['filters']) && !empty($_SESSION['filters'])) {
                    if (isset($_SESSION['filters']['jenis'][0]) && $_SESSION['filters']['jenis'][0] == 'skripsi') {
                        if (str_contains($queryThesis, 'WHERE')) {
                            $queryThesis = $queryThesis . " AND thesis_title LIKE '%" . $querySearch . "%'";
                        } else {
                            $queryThesis = $queryThesis . " WHERE thesis_title LIKE '%" . $querySearch . "%'";
                        }
                    } else if (isset($_SESSION['filters']['jenis'][0]) && $_SESSION['filters']['jenis'][0] == 'buku') {
                        if (str_contains($queryBook, 'WHERE')) {
                            $queryBook = $queryBook . " AND book_title LIKE '%" . $querySearch . "%'";
                        } else {
                            $queryBook = $queryBook . " WHERE book_title LIKE '%" . $querySearch . "%'";
                        }
                    }
                    // else {
                    //     $queryThesis = $queryThesis . " AND thesis_title LIKE '%" . $querySearch . "%'";
                    //     if (!isset($_SESSION['filters']['prodi'])){
                    //         $queryBook = $queryBook . " AND book_title LIKE '%" . $querySearch . "%'";
                    //     }
                    // }
                } else {
                    $queryBook = $queryBook . " WHERE book_title LIKE '%" . $querySearch . "%'";
                    $queryThesis = $queryThesis . " WHERE thesis_title LIKE '%" . $querySearch . "%'";
                }
            }

            if ($sort == 'title') {
                $query = "SELECT id FROM ($queryBook $queryUnion $queryThesis) AS D ORDER BY title LIMIT $limit OFFSET $start";
            } else if ($sort == 'year') {
                $query = "SELECT id FROM ($queryBook $queryUnion $queryThesis) AS D ORDER BY year DESC LIMIT $limit OFFSET $start";
            }


            // var_dump($query);
            $collection = Database::query($query);

            $countResult = Database::query("SELECT count(id) as jumlah FROM ($queryBook $queryUnion $queryThesis) AS D")->fetch_assoc();

            while ($row = $collection->fetch_column()) {
                if (str_starts_with($row, 'BK')) {
                    $content[] = new Book($row);
                } else {
                    // var_dump($row);
                    $content[] = new Thesis($row);
                }
            }
            $_SESSION['end'] = count($content);
            $_SESSION['countResult'] = $countResult['jumlah'];
            return $content;
        } catch (Exception $e) {
            $_SESSION['start'] =  0;
            $_SESSION['end'] = 0;
            $_SESSION['countResult'] = 0;
            return $content;
        }
    }

    public static function getCountCollection(): int
    {
        $res = Database::query("select COUNT(*) from ( select book_id from book UNION select thesis_id from thesis ) as d")->fetch_column();
        return (int)$res;
    }

    public static function getNumPages(): int
    {
        $res = Database::query("select COUNT(*) from ( select book_id from book UNION select thesis_id from thesis ) as d")->fetch_column();
        // var_dump(round((int)$res / MAX_NUMS_ITEM));
        return round((int)$res / MAX_NUMS_ITEM);
    }

    public static function getAllYearPublished(): array
    {
        $yearsBook = new Book();
        $yearsThesis = new Thesis();
        // var_dump($yearsBook->getAllYearPublished());
        return array_merge($yearsBook->getAllYearPublished(), $yearsThesis->getAllYearPublished());
    }

    public function bookDesc($id): Readable
    {
        return new Book($id);
    }
    public function thesisDesc($id): Readable
    {
        return new Thesis($id);
    }
}
