
function sort(sort) {
    // console.log(2131231);
    $.ajax({
        type: "POST",
        url: "?function=books",
        data: 'sort=' + sort.value,
        success: function (res) {
            $("#books-collection").html(res);
        }, error: function (response) {
            console.log(response.responseText);
        }
    });
}
function search(obj){
    $.ajax({
        type: "POST",
        url: "?function=search",
        data: 'q=' + $(obj).val(),
        success: function (res) {
            $("#books-collection").html(res);
        }, error: function (response) {
            console.log(response.responseText);
        }
    });
}


function addFilterItem(text, id, name) {
    // console.log(name);
    if ($(".filtered-items").find('#' + id).length == 0) {
        var test = '<div name="' + name + '" id="' + id + '" class="d-flex filter-item text-nowrap"> <p class="filtered-title">' + text + '</p> <button class="filter-item-closed d-flex" onclick="remove(this);" id="' + id + '"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none"> <path stroke="#7F7F7F" stroke-linecap="round" stroke-linejoin="round" d="M8 15.167c3.667 0 6.667-3 6.667-6.667s-3-6.667-6.667-6.667-6.667 3-6.667 6.667 3 6.667 6.667 6.667Zm-1.887-4.78 3.774-3.774m0 3.774L6.113 6.613" /> </svg></button></div>';
        // var txt = '<div name="' + name + '" id="' + id + '" class="d-flex filter-item rounded-3 text-nowrap"><span>' + text + '</span><button onclick="remove(this);" id="' + id + '"><img src="assets/icon/close-circle-gr.svg" alt=""></button></div>';
        $(".filtered-items").append(test);
    }
}

function removeFilterItem(id, name) {
    $(".filtered-items #" + id).remove();
    $("button.btn-filter#" + id).removeClass('active');
    $('.form-check input#' + id).prop('checked', false);
    // console.log($(".filtered-items #" + id).attr('class'));
}
function remove(obj) {
    // console.log($(obj).attr("id"));
    removeFilterItem($(obj).attr("id"), 'blah');
}

function changePages(obj){
    // $($('.total-views')[0]).html('Menampilkan ! dari 20 koleksi');
    $('a.page.active').each(function(i, obj){
        $(obj).removeClass('active');
        // console.log(obj);
    });
    $.ajax({
        type: "POST",
        url: "?function=books",
        data: 'page='+obj.getAttribute('id').substr(2),
        success: function (res) {
            $("#books-collection").html(res);
            $('a.page#P-'+obj.getAttribute('id').substr(2)).addClass('active');
            $('#count').html($('.book-collection.d-flex').length);
        }, error: function (response) {
            console.log(response.responseText);
        }
    });
}
$(document).ready(function () {
    $('.filtered-items').on('DOMSubtreeModified', function () {
        filterData = {};
        $('.filter-item').each(function(i, obj) {
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
            data: 'filter='+JSON.stringify(filterData),
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


    $('a#P-'+$.cookie("page")).addClass('active');


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

    // $.ajax({
    //     type: "GET",
    //     url: "?function=getFilters",
    //     // data: 'sort=title',
    //     success: function (res) {
    //         $(".filter-groups").html(res);
    //     }, error: function (response) {
    //         console.log(response.responseText);
    //     }
    // });

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
    // $.ajax({
    //     type: "POST",
    //     contentType: "application/json",
    //     url: "fungsi/catalog.php?catalog=filter",
    //     data: JSON.stringify(array),
    //     success: function (res) {
    //         $("#book-grids").html(res);
    //     },
    //     error: function (response) {
    //         console.log(response.responseText);
    //     }
    // });

});

$("button.btn-filter").click(function () {
    var array = {
        'name': $(this).attr('name'),
        'val': $(this).attr('id')
    }
    // console.log(JSON.stringify(array));
    // $.ajax({
    //     type: "POST",
    //     contentType: "application/json",
    //     url: "fungsi/catalog.php?catalog=filter",
    //     data: JSON.stringify(array),
    //     success: function (res) {
    //         $("#book-grids").html(res);

    //     },
    //     error: function (response) {
    //         console.log(response.responseText);
    //     }
    // });
    // console.log($(this).attr('class'));
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


//   $("#close-panel-cart").click(function() {
//     $("#panel-cart").css("display", "none");
//   });
//   $("input#nama").focus(function() {
//     $(this).removeClass("icon-calendar");
//   });
//   $("input#nama").blur(function() {
//     $(this).addClass("icon-calendar");
//   });
//   $("#myModal #pinjam").click(function() {
//     $("#panel-cart").css("display", "flex");
//     $("#myModal .close").click();
//   });
// </script>