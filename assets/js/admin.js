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

function validateFormBook() {
    var isValid = true;
        if ($('select[name="shelf"]').val() === "Pilih Rak" || $('select[name="shelf"]').val() === null) {
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
                resetForm();
                $('#modalBuku').modal('show');
            });

            // FORM ADD BOOK
            $('select[name="category"]').change(function (){
                if ($(this).val() != 'add') {
                    $('input[name="add-category"]').prop('disabled', true);
                    $('input[name="add-category"]').prop('required', false);
                } else {
                    $('input[name="add-category"]').prop('disabled', false);
                    $('input[name="add-category"]').prop('required', true);
                }
            });
            $('select[name="author"]').change(function (){
                if ($(this).val() != 'add') {
                    $('input[name="add-author"]').prop('disabled', true);
                    $('input[name="add-author"]').prop('required', false);
                } else {
                    $('input[name="add-author"]').prop('disabled', false);
                    $('input[name="add-author"]').prop('required', true);
                }
            });
            $('select[name="publisher"]').change(function (){
                if ($(this).val() != 'add') {
                    $('input[name="add-publisher"]').prop('disabled', true);
                    $('input[name="add-publisher"]').prop('required', false);
                } else {
                    $('input[name="add-publisher"]').prop('disabled', false);
                    $('input[name="add-publisher"]').prop('required', true);
                }
            });
            $("#formData").submit(function(e) {
                e.preventDefault(); // Mencegah pengiriman form secara default

                if (validateFormBook()) {
                    // Mengumpulkan data form
                    var formData = new FormData(this);
                    $.ajax({
                        url: '?page=book',
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            alert(data);
                            $('#modalBuku').modal('hide');
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                } else {
                    alert('Pilih Rak!');
                }
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