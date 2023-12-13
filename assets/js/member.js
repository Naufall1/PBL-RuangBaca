
// MAIN
var mod = 'book';

$(document).ready(function () {
    loadModule(mod);
    loadCart();

    $('a#rightSidebarToggler').click(function () {
        if (mod == 'book') {
            openCart();
        }
        // else if (mod == 'history') {
        //     openDetails();
        // }
    });

    $(".close-button").click(function () {
        $(".cart-container").css("display", "none");
    });

    $(".menus-container > a").click(function () {
        for (let index = 0; index < array.length; index++) {
            const element = array[index];

        }
        $(".cart-container").css("display", "none");
    });

    $(".filter-header button").click(function () {
        var display = $(this).next(".filter-box").css("display");
        if (display != "none") {
            $(this).next(".filter-box").fadeOut("fast");
        } else {
            $(this).next(".filter-box").fadeIn();
        }
    });

    $(".menu#history").click(function () {
        $(".container-nav > .content-nav > input").css("display", "none");
        $(".container-nav > .content-nav > .heading-page").css("display", "flex");
    });

    $("#book").click(function () {
        console.log('book');
        $(".container-nav > .content-nav > input").css("display", "block");
        $(".container-nav > .content-nav > .heading-page").css("display", "none");
    });
});

function loadModule(moduleName) {
    mod = moduleName;
    $.ajax({
        type: "GET",
        url: "?page=" + moduleName,
        success: function (response) {
            resetRightSidebar();
            $('main.container-main').html(response);
            // $(".cart-container").css("display", "flex");
            $('main.container-main').ready(function () {
                try {
                    loadOnDocReady();
                } catch (error) {
                    if (!/Failed to execute 'observe'/.test(error.message)) {
                        console.log(error.message);
                    }
                }
            });
            $(".filter-group").change(function () {
                var array = {
                    "name": $(this).attr('name'),
                    "checked": [],
                    "unchecked": []
                };
                $(this).find("input:checkbox:not(:checked)").each(function () {
                    nama = $(this).next("label").attr("name");
                    id = $(this).next("label").attr("for");
                    array["unchecked"].push($(this).val());
                    //   console.log(id);
                    removeFilterItem(id, nama)
                });
                $(this).find("input:checkbox:checked").each(function () {
                    title = $(this).next("label").text();
                    nama = $(this).attr("name");
                    id = $(this).next("label").attr("for");
                    //   console.log(id);
                    array["checked"].push($(this).val());
                    // console.log(nama);
                    addFilterItem(title, id, nama);
                });
                // console.log(JSON.stringify(array));
            });

            $("button.btn-filter").click(function () {
                var array = {
                    'name': $(this).attr('name'),
                    'val': $(this).attr('id')
                }
                // console.log(JSON.stringify(array));

                var title = $(this).text()
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                if ($(this).attr('class').includes('active')) {
                    $(this).removeClass('active');
                    removeFilterItem(id, name);
                } else {
                    // console.log(title, id, name);
                    addFilterItem(title, id, name)
                    $(this).addClass('active');
                }
                // console.log($(this).attr('id'));
            });

            // History
            $('.tab-menu .tab-item').click(function () {
                $('.tab-item-active').addClass('tab-item');
                $('.tab-item-active').find('.tab-title-active').addClass('tab-title');
                $('.tab-item-active').find('.tab-title').removeClass('tab-title-active');
                $('.tab-item-active').removeClass('tab-item-active');
                $(this).find('.tab-title').addClass('tab-title-active');
                $(this).find('.tab-title').removeClass('tab-title');
                $(this).removeClass('tab-item');
                $(this).addClass('tab-item-active');
                loadBorrowingCards($(this).attr('id'));
            });
            $('.tab-item#all').find('.tab-title').addClass('tab-title-active');
            $('.tab-item#all').find('.tab-title').removeClass('tab-title');
            $('.tab-item#all').addClass('tab-item-active');
            $('.tab-item#all').removeClass('tab-item');
            if (moduleName === 'history') {
                loadBorrowingCards('all');
            }

        }
    });
}

function resetRightSidebar() {
    closeCart();
    closeDetails();
}

// CATALOG

function close() {
    $(".cart-container").css("display", "none");
}

function refreshCatalog(){
    try {
        page = JSON.parse($.cookie("page"));
    } catch (error) {
        console.log('Error parsing cookie (page)');
    }
    $.ajax({
        type: "POST",
        url: "?function=books",
        data: 'page='+page,
        success: function (res) {
            $("#books-collection").html(res);
            $('a.page#P-'+page).addClass('active');
            $('#count').html($('.book-collection.d-flex').length);
        }, error: function (response) {
            console.log(response.responseText);
        }
    });
}

function addCartItem(id, cover, title, author, year) {
    html = "\
    <div class='book-ordered-item d-flex' id='"+ id + "'>\
        <img class='book-ordered-image' src='uploads/cover/"+ cover + "' alt=''>\
        <div class='book-ordered-item-content d-flex flex-column'> \
            <p class='book-ordered-title'>"+ title + "</p>\
            <div class='book-orderd-sub-info d-flex'>\
                <div>\
                    <p class='book-ordered-author'>"+ author + "</p>\
                    <p class='book-ordered-year'>"+ year + "</p>\
                </div>\
                <button type='button' id='"+ id + "' onclick='removeCartItem(this);'>\
                    <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='none'>\
                        <path stroke='#E20000' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M17.5 4.983a84.752 84.752 0 0 0-8.35-.416c-1.65 0-3.3.083-4.95.25l-1.7.166m4.583-.841.184-1.092c.133-.792.233-1.383 1.641-1.383h2.184c1.408 0 1.516.625 1.641 1.391l.184 1.084m2.791 3.475-.541 8.391c-.092 1.309-.167 2.325-2.492 2.325h-5.35c-2.325 0-2.4-1.016-2.492-2.325l-.541-8.391m4.316 6.133h2.775m-3.466-3.333h4.166' />\
                    </svg>\
                </button>\
            </div>\
        </div>\
    </div>\
    <div class='hr-divider'></div>";
    $('.books-ordered-group').append(html);
}

function removeCartItem(id) {
    console.log($(id).attr('id'));
    $.ajax({
        type: "POST",
        url: "?function=cart/remove",
        data: "id=" + $(id).attr('id'),
        success: function (response) {
            // console.log(response);
            // loadCart();
            $('.books-ordered-group #' + $(id).attr('id')).next('.hr-divider').remove();
            $('.books-ordered-group #' + $(id).attr('id')).remove();
        }
    });
}

function loadCart() {
    $('.books-ordered-group').html('');
    var cart = [];
    try {
        cart = JSON.parse($.cookie("cart"));
    } catch (error) {
        console.log('Error parsing cookie (cart)');
    }
    cart.forEach(id => {
        if (id.match("^BK")) {
            $.ajax({
                type: 'POST',
                url: '?function=getDesc',
                data: 'book_id=' + id,
                success: function (res) {
                    var book = JSON.parse(res);
                    addCartItem(book['id'], book['cover'], book['title'], book['author'], book['year']);
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: '?function=getDesc',
                data: 'thesis_id=' + id,
                success: function (res) {
                    var thesis = JSON.parse(res);
                    addCartItem(thesis['id'], 'default.png', thesis['title'], thesis['writer_name'], thesis['year']);
                }
            });
        }
    });
}

function procAddToCart(id) {
    $.ajax({
        type: "POST",
        url: "?function=cart/add",
        data: "id=" + id,
        success: function (response) {
            // console.log(response);
            loadCart();
        }
    });
}

function addToCart(obj) {
    // console.log($(obj).attr('name'));
    var id = $(obj).attr('id');
    switch ($(obj).attr('name')) {
        case 'book':
            $('#modalBuku').modal('hide');
            break;
        case 'thesis':
            $('#modalSkripsi').modal('hide');
            break;
        default:
            break;
    }
    try {
        cart = JSON.parse($.cookie("cart"));
    } catch (error) {
        cart = [];
    }
    if (cart.includes(id)) {
        alert('exist');
    } else {
        procAddToCart(id);
    }
    openCart();
}

function openCart(){
    $(".not-editable-item#status").css("display", "none");
    $(".not-editable-item#reserve-date").css("display", "none");
    $(".not-editable-item#due-date").css("display", "none");
    $(".cart-container").css("display", "flex");
    $(".container-main").css("margin-right", "calc(297px)");
    $('.input-fields#reserve-date').css('display', 'flex');
    $('.submit-container > button').css("display", "flex");
}

function closeCart() {
    $(".cart-container").css("display", "none");
    $(".container-main").css("margin-right", "calc(20px + 297px - 297px)");
    $('.books-ordered-group').html('');
}

function pinjam() {
    var tanggal = $('input#reserve-date');
    if (tanggal.val() == "") {
        alert('Tanggal Wajib Diisi!!!');
    } else {
        $.ajax({
            type: "POST",
            url: "?function=cart/checkout",
            data: "date="+tanggal.val(),
            success: function (response) {
                console.log(response);
                $('.books-ordered-group').html('');
                close();
                alert('Success.');
                refreshCatalog();
            }
        });
    }
    // alert(tanggal.val());
}


// History Page
function loadBorrowingCards(status) {
    $.ajax({
        type: "POST",
        url: "?function=history/cards",
        data: "status=" + status,
        success: function (response) {
            var response = JSON.parse(atob(response));
            $('.borrowing-cards-container[name="main"]').html(response['data']);
            $('.borrowing-cards-container[name="latest"]').html(response['latest']);
        }
    });
}

function loadModal(id, statusId) {
    // Reset Readable Item
    $('.books-ordered-group').html('');
    // Finish Reset Readable Item

    // Request details borrowing
    $.ajax({
        type: "POST",
        url: "?function=history/details",
        data: "id=" + id,
        success: function (response) {
            console.log(JSON.parse(response));
            data = JSON.parse(response);
            if (data['readable'].length > 1) {
                data['readable'].forEach(item => {
                    readable = JSON.parse(item);
                    addToDetails(readable['id'],readable['cover'],readable['title'],readable['author'],readable['year']);
                    // console.log(readable);
                })
            } else {
                readable = JSON.parse(data['readable']);
                addToDetails(readable['id'],readable['cover'],readable['title'],readable['author'],readable['year']);
            }
            $(".not-editable-item#status").css("display", "flex");
            $(".not-editable-item#status .borrowing-status").attr('id', statusId);
            $(".not-editable-item#status .borrowing-status > p").html(data['status'].charAt(0).toUpperCase() + data['status'].slice(1));
            $(".not-editable-item#reserve-date > p").html(data['reserve_date']);
            $(".not-editable-item#due-date > p").html(data['due_date']);

            openDetails();
        }
    });
}

function addToDetails(id, cover, title, author, year) {
    html = "\
    <div class='book-ordered-item d-flex' id='"+ id + "'>\
        <img class='book-ordered-image' src='uploads/cover/"+ cover + "' alt=''>\
        <div class='book-ordered-item-content d-flex flex-column'> \
            <p class='book-ordered-title'>"+ title + "</p>\
            <div class='book-orderd-sub-info d-flex'>\
                <div>\
                    <p class='book-ordered-author'>"+ author + "</p>\
                    <p class='book-ordered-year'>"+ year + "</p>\
                </div>\
            </div>\
        </div>\
    </div>\
    <div class='hr-divider'></div>";
    $('.books-ordered-group').append(html);
}
function openDetails() {
    $('.input-fields#reserve-date').css('display', 'none');
    $(".cart-container").css("display", "flex");
    $(".not-editable-item#status").css("display", "flex");
    $(".not-editable-item#reserve-date").css("display", "flex");
    $(".not-editable-item#due-date").css("display", "flex");
    $('.submit-container > button').css("display", "none");
}
function closeDetails() {
    $(".cart-container").css("display", "none");
}