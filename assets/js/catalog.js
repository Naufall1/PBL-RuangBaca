
function sort(sort) {
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
function search(obj) {
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
    if ($(".filtered-items").find('#' + id).length == 0) {
        var test = '<div name="' + name + '" id="' + id + '" class="d-flex filter-item text-nowrap"> <p class="filtered-title">' + text + '</p> <button class="filter-item-closed d-flex" onclick="remove(this);" id="' + id + '"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none"> <path stroke="#7F7F7F" stroke-linecap="round" stroke-linejoin="round" d="M8 15.167c3.667 0 6.667-3 6.667-6.667s-3-6.667-6.667-6.667-6.667 3-6.667 6.667 3 6.667 6.667 6.667Zm-1.887-4.78 3.774-3.774m0 3.774L6.113 6.613" /> </svg></button></div>';
        $(".filtered-items").append(test);
    }
}

function removeFilterItem(id, name) {
    $(".filtered-items #" + id).remove();
    $("button.btn-filter#" + id).removeClass('active');
    $('.form-check input#' + id).prop('checked', false);
}
function remove(obj) {
    removeFilterItem($(obj).attr("id"), 'blah');
}

function changePages(obj) {
    $('a.page.active').each(function (i, obj) {
        $(obj).removeClass('active');
    });
    $.ajax({
        type: "POST",
        url: "?function=books",
        data: 'page=' + obj.getAttribute('id').substr(2),
        success: function (res) {
            $("#books-collection").html(res);
            $('a.page#P-' + obj.getAttribute('id').substr(2)).addClass('active');
            $('#count').html($('.book-collection.d-flex').length);
        }, error: function (response) {
            console.log(response.responseText);
        }
    });

}
function handleMutations(mutationsList, observer) {
    filterData = {};
    $('.filter-item').each(function (i, obj) {
        console.log(obj);
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
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
    console.log(filterData);
}

function loadOnDocReady() {
    // Create a MutationObserver instance
    const observer = new MutationObserver(handleMutations);

    // Target the element you want to observe
    const targetNode = document.querySelector('.filtered-items');

    // Configuration of the observer:
    const config = { subtree: true, childList: true, characterData: true };

    // Start observing the target node for configured mutations
    observer.observe(targetNode, config);



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
}

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
        removeFilterItem(id, nama)
    });
    $(this).find("input:checkbox:checked").each(function () {
        title = $(this).next("label").text();
        nama = $(this).attr("name");
        id = $(this).next("label").attr("for");
        array["checked"].push($(this).val());
        addFilterItem(title, id, nama);
    });
});

$("button.btn-filter").click(function () {
    var array = {
        'name': $(this).attr('name'),
        'val': $(this).attr('id')
    }
    var title = $(this).text()
    var id = $(this).attr('id');
    var name = $(this).attr('name');
    if ($(this).attr('class').includes('active')) {
        $(this).removeClass('active');
        removeFilterItem(id, name);
    } else {
        addFilterItem(title, id, name)
        $(this).addClass('active');
    }
});
$('.filter-title').click(function () {
    if ($(this).next('.filter-contents').css("display") == "flex") {
        $(this).next('.filter-contents').removeClass('d-flex');
        $(this).next('.filter-contents').css('display', 'none');
        $(this).find('img').attr('src', 'assets/icon/arrow-down.svg');
    } else if ($(this).next('.filter-contents').css("display") == "none") {
        $(this).next('.filter-contents').addClass('d-flex');
        console.log(2131231);
        $(this).find('img').attr('src', 'assets/icon/arrow-up.svg');
        $(this).next('.filter-contents').css("display", 'block');
    }
});