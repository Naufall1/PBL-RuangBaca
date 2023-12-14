function changeTableHeading(title) {
    $('.heading-table-page').html(title);
    $('.subtitle-table-page').html('Table ' + title)
}

function loadSearch(moduleName) {
    $('input[name="search"]').keyup(function (e) {
        if (e.keyCode == 13) {
            $.ajax({
                type: "GET",
                url: "?function=search/"+moduleName+"&q=" + $(this).val(),
                success: function (response) {
                    $('main.container-main').html(response);
                    loadSearch(moduleName);
                }
            });
        }
    });
}

// function changePage(mod, page) {
//     $.ajax({
//         type: "GET",
//         url: "?page=" + mod,
//         data: "num=" + page,
//         success: function (response) {
//             $('main.container-main').html(response);
//         }
//     });
// }

/**
 * Create Section
 */
function validateFormBook() {
    var isValid = true;
    if ($('select[name="shelf"]').val() === "Pilih Rak"  || $('select[name="shelf"]').val() === null) {
        isValid = false;
    }
    return isValid;
}
function validateFormThesis() {
    var isValid = true;
    if ($('select[name="shelf"]').val() === "Pilih Rak" || $('select[name="shelf"]').val() === null){
        isValid = false;
    }
    if ($('select[name="lecturer_id1"]').val() === "Pilih Dosen" || $('select[name="lecturer_id1"]').val() === null) {
        isValid = false;
    }
    if ($('select[name="lecturer_id2"]').val() === "Pilih Dosen" || $('select[name="lecturer_id2"]').val() === null) {
        isValid = false;
    }
    return isValid;
}
function resetForm() {
    // Reset nilai input teks dan textarea
    $("#title, #synopsis, #add-category, #add-author, #add-publisher, #year, #stock, #isbn, #ddc_code").val("");

    // Reset nilai dropdowns
    $("#inputGroupSelect01\\ category, #inputGroupSelect01\\ author, #inputGroupSelect01\\ publisher, #inputGroupSelect01\\ shelf").prop("selectedIndex", 0);

    // Reset nilai file input
    $("#cover").val("");

    $('input[name="add-publisher"]').prop('disabled', false);
    $('input[name="add-publisher"]').prop('required', true);
    $('input[name="add-author"]').prop('disabled', false);
    $('input[name="add-author"]').prop('required', true);
    $('input[name="add-category"]').prop('disabled', false);
    $('input[name="add-category"]').prop('required', true);
}
function addShelf() {
    $.ajax({
        type: "POST",
        url: "?page=shelf",
        data: "nextId",
        success: function (response) {
            $('#modalAdd input[name="id"]').val(response);
            $('#modalAdd').modal('show');
        }
    });
}
function uploadDataAdd(mod, data) {
    $.ajax({
        url: '?page='+mod,
        type: 'POST',
        data: data,
        success: function (res) {
            if (res == 'success') {
                alert(res);
                loadModule(mod);
                $('#modalAdd').modal('hide');
            } else {
                alert(res);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

/**
 *
 * Update section
*/
function uploadDataEdit(mod, data) {
    $.ajax({
        url: '?page='+mod,
        type: 'POST',
        data: data,
        success: function (res) {
            alert(res);
            $('#modalEdit').modal('hide');
        },
        cache: false,
        contentType: false,
        processData: false
    });
}
function editBook(id) {
    $.ajax({
        type: 'POST',
        url: '?function=getDesc',
        data: 'book_id=' + id,
        success: function(res) {
            // console.log(JSON.parse(res));
            var book = JSON.parse(res);
            $('#modalEdit').find('#book_id').val(book['id']);
            $('#modalEdit').find('#title').val(book['title']);
            $('#modalEdit').find('#cover').attr('src','uploads/cover/'+ book['cover']);
            $('#modalEdit').find('select[name="author"] > option[value="'+book['author_id']+'"]').prop('selected',true);
            $('#modalEdit').find('select[name="publisher"] > option[value="'+book['publisher_id']+'"]').prop('selected',true);
            $('#modalEdit').find('select[name="category"] > option[value="'+book['category_id']+'"]').prop('selected',true);
            $('#modalEdit').find('input[name="year"]').val(book['year']);
            $('#modalEdit').find('select[name="shelf"] > option[value="'+book['shelf']+'"]').prop('selected',true);
            $('#modalEdit').find('textarea[name="synopsis"]').html(book['synopsis']);
            $('#modalEdit').find('input[name="stock"]').val(book['avail']);
            $('#modalEdit').find('input[name="isbn"]').val(book['isbn']);
            $('#modalEdit').find('input[name="ddc_code"]').val(book['ddc_code']);
            $('#modalEdit').find('input[name="cover"]').val('');
            $('#modalEdit').find('button[name="book"]').attr('id', book['id']);
        }, error: function(err) {
            console.log(err);
        }
    });

    setTimeout(function() {
        $('#modalEdit').modal('show');
    }, 50);
}
function editThesis(id) {
    $.ajax({
        type: 'POST',
        url: '?function=getDesc',
        data: 'thesis_id=' + id,
        success: function(res) {
            console.log(JSON.parse(res));
            var thesis = JSON.parse(res);
            var dospem = thesis['dospem'].split(',');
            $('#modalEdit').find('input[name="id"]').val(thesis['id']);
            $('#modalEdit').find('input[name="thesis_title"]').val(thesis['title']);
            // $('#modalEdit').find('#cover').attr('src','uploads/cover/default.png');
            $('#modalEdit').find('input[name="writer_name"]').val(thesis['author']);
            $('#modalEdit').find('input[name="writer_NIM"]').val(thesis['writer_nim']);
            $('#modalEdit').find('input[name="year_published"]').val(thesis['year']);

            $('#modalEdit').find('select[name="lecturer_id1"] > option:contains("'+dospem[0]+'")').prop('selected',true);
            $('#modalEdit').find('select[name="lecturer_id2"] > option:contains("'+dospem[1]+'")').prop('selected',true);
            $('#modalEdit').find('select[name="shelf"] > option[value="'+thesis['shelf']+'"]').prop('selected',true);
        }, error: function(err) {
            console.log(err);
        }
    });
    setTimeout(function() {
        $('#modalEdit').modal('show');
    }, 50);
}
function editSingle(id) {
    var value = $('td[name="id"]:contains("'+id+'")').next('td[name="main"]').html();
    $('#modalEdit').find('#id').val(id);
    $('#modalEdit').find('#main').val(value);
    $('#modalEdit').modal('show');
}

/**
 *
 * Delete section
 */

function deleteById(id) {
    $('.delete-confirmation > span').html(id);
    $('#modalDelete').modal('show');
}

function processDelete() {
    var id = $('.delete-confirmation > span').html();
    var mod = $('.delete-confirmation').attr('mod');
    $.ajax({
        type: "POST",
        url: "?page="+mod,
        data: "id="+id+"&delete",
        success: function (res) {
            alert(res);
            loadModule(mod);
            $('#modalDelete').modal('hide');
        }
    });
}

function loadModule(moduleName, page=-1) {
    switch (moduleName) {
        case 'book':
            changeTableHeading('Buku');
            break;
        case 'author':
            changeTableHeading('Penulis');
            break;
        case 'publisher':
            changeTableHeading('Penerbit');
            break;
        case 'category':
            changeTableHeading('Kategori');
            break;
        case 'thesis':
            changeTableHeading('Skripsi');
            break;
        case 'lecture':
            changeTableHeading('Dosen');
            break;
        case 'member':
            changeTableHeading('Anggota');
            break;
        case 'borrowing':
            changeTableHeading('Peminjaman');
            break;
        case 'shelf':
            changeTableHeading('Rak');
            break;
        default:
            break;
    }
    $.ajax({
        type: "GET",
        url: "?page=" + moduleName + (page >= 1 ? "&num=" + page : ""),
        // data: "num=" + page,
        success: function (response) {
            $('main.container-main').html(response);

            loadSearch(moduleName);

            $('.action-container button').click(function () {
                resetForm();
                // $('#modalBuku').modal('show');
            });

            $('a[name="pagination"]').click(function (e) {
                loadModule(moduleName, $(this).html());
            });

            // FORM ADD BOOK
            $('select[name="category"]').change(function () {
                // alert('change');
                if ($(this).val() != 'add') {
                    $('input[name="add-category"]').prop('disabled', true);
                    $('input[name="add-category"]').prop('required', false);
                } else {
                    $('input[name="add-category"]').prop('disabled', false);
                    $('input[name="add-category"]').prop('required', true);
                }
            });
            $('select[name="author"]').change(function () {
                if ($(this).val() != 'add') {
                    $('input[name="add-author"]').prop('disabled', true);
                    $('input[name="add-author"]').prop('required', false);
                } else {
                    $('input[name="add-author"]').prop('disabled', false);
                    $('input[name="add-author"]').prop('required', true);
                }
            });
            $('select[name="publisher"]').change(function () {
                if ($(this).val() != 'add') {
                    $('input[name="add-publisher"]').prop('disabled', true);
                    $('input[name="add-publisher"]').prop('required', false);
                } else {
                    $('input[name="add-publisher"]').prop('disabled', false);
                    $('input[name="add-publisher"]').prop('required', true);
                }
            });
            $("#formAddBook").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                if (validateFormBook()) {
                    // Mengumpulkan data form
                    var formData = new FormData(this);
                    uploadDataAdd(moduleName,formData);
                } else {
                    alert('Pilih Rak!');
                }
            });
            // END FORM ADD BOOK

            // FORM ADD AUTHOR
            $("#formAddAuthor").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                // Mengumpulkan data form
                var formData = new FormData(this);
                uploadDataAdd(moduleName,formData);
            });
            // END FORM ADD AUTHOR

            // FORM ADD PUBLISHER
            $("#formAddPublisher").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                // Mengumpulkan data form
                var formData = new FormData(this);
                uploadDataAdd(moduleName,formData);
            });
            // END FORM ADD PUBLISHER

            // FORM ADD CATEGORY
            $("#formAddCategory").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                // Mengumpulkan data form
                var formData = new FormData(this);
                uploadDataAdd(moduleName,formData);
            });
            // END FORM ADD CATEGORY

            // FORM ADD LECTURER
            $("#formAddLecturer").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                // Mengumpulkan data form
                var formData = new FormData(this);
                uploadDataAdd(moduleName,formData);
            });
            // END FORM ADD LECTURER

            // FORM ADD THESIS
            $("#formAddThesis").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                if (validateFormThesis()) {
                    // Mengumpulkan data form
                    var formData = new FormData(this);
                    uploadDataAdd(moduleName,formData);
                } else {
                    alert("Please fill all fields!");
                }
            });
            // END FORM ADD THESIS

            // FORM ADD
            $("#formAdd").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                $('input[type="text"][name="id"]').prop('disabled', false);
                // Mengumpulkan data form
                var formData = new FormData(this);
                uploadDataAdd(moduleName,formData);
            });
            // END FORM ADD

            // FORM EDIT SINGLE
            $("#formEdit").submit(function (e) {
                e.preventDefault();
                $('input[type="text"][name="id"]').prop('disabled', false);
                var formData = new FormData(this);
                uploadDataEdit(moduleName,formData);
            });
            // END FORM EDIT SINGLE
        }
    });
}

$(document).ready(function () {
    loadModule('book');
});