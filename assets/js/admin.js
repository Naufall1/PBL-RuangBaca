function changeTableHeading(title) {
    $('.heading-table-page').html(title);
    $('.subtitle-table-page').html('Table ' + title)
}

function loadSearch(moduleName) {
    switch (moduleName) {
        case 'book':
            $('input[name="search-book"]').keyup(function (e) {
                if (e.keyCode == 13) {
                    $.ajax({
                        type: "POST",
                        url: "?function=search/book",
                        data: "q=" + $(this).val(),
                        success: function (response) {
                            $('main.container-main').html(response);
                            // console.log(response);
                            loadSearch(moduleName);
                        }
                    });
                }
            });
            break;
        case 'author':
            $('input[name="search-author"]').keyup(function (e) {
                if (e.keyCode == 13) {
                    $.ajax({
                        type: "POST",
                        url: "?function=search/author",
                        data: "q=" + $(this).val(),
                        success: function (response) {
                            $('main.container-main').html(response);
                            loadSearch(moduleName);
                        }
                    });
                }
            });
            break;
        case 'publisher':
            break;
        case 'category':
            break;
        case 'thesis':
            break;
        case 'lecture':
            break;
        case 'member':
            break;
        case 'borrowing':
            break;
        case 'shelf':
            break;
        default:
            break;
    }
}

function loadModule(moduleName) {
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
        url: "?page=" + moduleName,
        success: function (response) {
            $('main.container-main').html(response);

            loadSearch(moduleName);

            // Book
            $('.action-container button').click(function () {
                alert('msg');
            });
        }
    });
}
function edit(id) {
    console.log($(id).attr('name'));
}

$(document).ready(function () {
    loadModule('book');
});