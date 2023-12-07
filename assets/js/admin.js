function changeTableHeading(title) {
    $('.heading-table-page').html(title);
    $('.subtitle-table-page').html('Table ' + title)
}

function loadSearch() {
    $('input[name="search-author"]').keyup(function (e) {
        if (e.keyCode == 13)
            alert($(this).val());
    });
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