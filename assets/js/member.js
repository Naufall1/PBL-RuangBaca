function close() {
    // $(".cart-container").removeClass("d-flex");
    $(".cart-container").css("display", "none");
    // console.log('khdsafdad')
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

function loadModule(moduleName) {
    $.ajax({
        type: "GET",
        url: "?page=" + moduleName,
        success: function (response) {
            $('main.container-main').html(response);
            // $(".cart-container").css("display", "flex");
            $('main.container-main').ready(function () {
                $('.filtered-items').on('DOMSubtreeModified', function () {
                    filterData = {};
                    $('.filter-item').each(function (i, obj) {
                        // console.log(obj);
                        if (obj.getAttribute('name') in filterData) {
                            if (obj.getAttribute('name') != 'year') {
                                filterData[obj.getAttribute('name')].push(obj.getAttribute('id'));
                            } else {
                                filterData[obj.getAttribute('name')].push(obj.getAttribute('id').substr(1));
                            }
                        } else {
                            if (obj.getAttribute('name') != 'year') {
                                filterData[obj.getAttribute('name')] = []
                                filterData[obj.getAttribute('name')].push(obj.getAttribute('id'));
                            } else {
                                filterData[obj.getAttribute('name')] = []
                                filterData[obj.getAttribute('name')].push(obj.getAttribute('id').substr(1));
                            }
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '?function=filter',
                        data: 'filter=' + JSON.stringify(filterData),
                        success: function (res) {
                            $("#books-collection").html(res);
                            // console.log(res);
                        }, error: function (response) {
                            console.log(response.responseText);
                        }
                    })
                    // $(this).ready(function(){
                    console.log(filterData);
                    // });
                });

                $('a#P-' + $.cookie("page")).addClass('active');

                $.ajax({
                    type: "POST",
                    url: "?function=books",
                    data: 'sort=title',
                    success: function (res) {
                        // console.log('test result');
                        $("#books-collection").html(res);
                    }, error: function (response) {
                        console.log(response.responseText);
                    }
                });
                try {
                    // page = JSON.parse($.cookie("page"));
                    filter = JSON.parse($.cookie("filter"));
                    $.each(filter, function (propName, propVal) {
                        if (propName == 'jenis' || propName == 'ketersediaan') {
                            for (let i = 0; i < propVal.length; ++i) {
                                var title = $("button#" + propVal[i]).text();
                                var id = $("button#" + propVal[i]).attr('id');
                                var name = $("button#" + propVal[i]).attr('name');
                                addFilterItem(title, id, name);
                            }
                        } else {
                            for (let i = 0; i < propVal.length; i++) {
                                // console.log($("input[name="+propName+"]#"+propVal[i]).next("label").text());
                                title = $("input[name=" + propName + "]#" + propVal[i]).next("label").text();
                                name = $("input[name=" + propName + "]#" + propVal[i]).next("label").attr("name");
                                id = $("input[name=" + propName + "]#" + propVal[i]).next("label").attr("id");
                                addFilterItem(title, id, name);
                            }
                        }
                    });
                    for (let i = 0; i < filter['jenis'].length; ++i) {
                        val = filter['jenis'][i];
                        $("button.btn-filter#" + val).css("background-color", "grey");
                        $("button.btn-filter#" + val).addClass('active')
                    }
                    for (let i = 0; i < filter['ketersediaan'].length; ++i) {
                        val = filter['ketersediaan'][i];
                        $("button.btn-filter#" + val).css("background-color", "grey");
                        $("button.btn-filter#" + val).addClass('active')
                    }
                    for (let i = 0; i < filter['lokasi'].length; ++i) {
                        val = filter['lokasi'][i];
                        $("input#" + val).prop("checked", true);
                    }
                    for (let i = 0; i < filter['kategori'].length; ++i) {
                        val = filter['kategori'][i];
                        $("input#" + val).prop("checked", true);
                    }
                    for (let i = 0; i < filter['pengarang'].length; ++i) {
                        val = filter['pengarang'][i];
                        $("input#" + val).prop("checked", true);
                    }
                    for (let i = 0; i < filter['penerbit'].length; ++i) {
                        val = filter['penerbit'][i];
                        $("input#" + val).prop("checked", true);
                    }
                    for (let i = 0; i < filter['tahun_terbit'].length; ++i) {
                        val = filter['tahun_terbit'][i];
                        $("input#" + val).prop("checked", true);
                    }
                } catch (error) {
                    console.log('Error parsing cookie (Filter)');
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

            $('.filter-title').click(function () {
                // console.log($(this).next('.filter-contents').css("display"));
                if ($(this).next('.filter-contents').css("display") == "flex") {
                    $(this).next('.filter-contents').removeClass('d-flex');
                    $(this).next('.filter-contents').css('display', 'none');
                    // console.log($(this).find('img').attr('src'));
                    $(this).find('img').attr('src', 'assets/icon/arrow-down.svg');
                } else if ($(this).next('.filter-contents').css("display") == "none") {
                    $(this).next('.filter-contents').addClass('d-flex');
                    console.log(2131231);
                    $(this).find('img').attr('src', 'assets/icon/arrow-up.svg');
                    $(this).next('.filter-contents').css("display", 'block');
                }
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

    $(".cart-container").css("display", "flex");
    // $('#modalSkripsi').modal('hide');
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

$(document).ready(function () {
    loadModule('book');
    loadCart();

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
});


// History Page
function loadBorrowingCards(status) {
    $.ajax({
        type: "POST",
        url: "?page=history",
        data: "status=" + status,
        success: function (response) {
            var response = JSON.parse(atob(response));
            console.log(response);
            $('.borrowing-cards-container[name="main"]').html(response['data']);
            $('.borrowing-cards-container[name="latest"]').html(response['latest']);
            // console.log(JSON.parse(atob(response)));
        }
    });
}