function loadModule(moduleName) {
    $.ajax({
        type: "GET",
        url: "?page=" + moduleName,
        success: function (response) {
            $('main.container-main').html(response);

            // Dashboard


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
            loadBorrowingCards('all');
        }
    });
}

function loadBorrowingCards(status) {
    $.ajax({
        type: "POST",
        url: "?page=dashboard",
        data: "status=" + status,
        success: function (response) {
            // console.log(response);
            $('.borrowing-cards-container').html(response);
        }
    });
}

$(document).ready(function () {
    loadModule('dashboard');

    $(".filter-header button").click(function () {
        var display = $(this).next(".filter-box").css("display");
        if (display != "none") {
            $(this).next(".filter-box").fadeOut("fast");
        } else {
            $(this).next(".filter-box").fadeIn();
        }
    });

});