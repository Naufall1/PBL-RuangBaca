
function close() {
    // $(".cart-container").removeClass("d-flex");
    $(".cart-container").css("display", "none");
    // console.log('khdsafdad')
}

function loadModule(moduleName) {
    $.ajax({
        type: "GET",
        url: "?page=" + moduleName,
        success: function (response) {
            $('main.container-main').html(response);
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
                        console.log('test result');
                        $("#books-collection").html(res);
                    }, error: function (response) {
                        console.log(response.responseText);
                    }
                });

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

        }
    });
}

$(document).ready(function () {
    loadModule('book');

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