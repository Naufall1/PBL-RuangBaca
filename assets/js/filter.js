{/* <script> */ }
function addFilterItem(text, id, name) {
    if ($("#filter-implement-box").find('#' + id).length == 0) {
        var txt = '<div name="' + name + '" id="' + id + '" class="d-flex filter-item rounded-3 text-nowrap"><span>' + text + '</span><button onclick="remove(this);" id="' + id + '"><img src="assets/icon/close-circle-gr.svg" alt=""></button></div>';
        $("#filter-implement-box").append(txt);
    }
}

function removeFilterItem(id, name) {
    $("#filter-implement-box #" + id).remove();
    $("button.btn-filter#" + id).removeClass('active');
    $('.form-check input#' + id).prop('checked', false);
}
function remove(obj) {
    // console.log($(obj).attr("id"));
    removeFilterItem($(obj).attr("id"), 'blah');
}
$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "?function=books",
        success: function (res) {
            $("#book-grids").html(res);


            $("#book-grids .book").click(function () {
                // console.log($(this).attr("id"));
                book_id = $(this).attr("id");

                // $.ajax({
                //   type: "POST",
                //   url: "fungsi/catalog.php?catalog=book",
                //   data: "book="+book_id,
                //   success: function(res) {
                //     // $("#panel-cart").html(res);
                //   },
                //   error: function(response) {
                //     console.log(response.responseText);
                //   }
                // });
                // $("#panel-cart").css("display","flex");
                title = $(this).find("#title").text();
                penulis = $(this).find("#penulis").text();
                tahun = $(this).find("#tahun_terbit").text();
            });
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

$(".filter-box").change(function () {
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
        nama = $(this).next("label").attr("name");
        id = $(this).next("label").attr("for");
        //   console.log(id);
        array["checked"].push($(this).val());
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

$('.filter-header button').click(function () {
    // console.log($(this).next('.filter-box').css("display"));
    if ($(this).next('.filter-box').css("display") == "block") {
        $(this).next('.filter-box').css('display', 'none');
        // console.log($(this).find('img').attr('src'));
        $(this).find('img').attr('src', 'assets/icon/arrow-down.svg');
    } else if ($(this).next('.filter-box').css("display") == "none") {
        $(this).find('img').attr('src', 'assets/icon/arrow-up.svg');
        $(this).next('.filter-box').css("display", 'block');
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