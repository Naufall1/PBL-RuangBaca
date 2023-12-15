$(document).ready(function () {
    $('.menus-group a').click(function () {
        $('.menus-group .menu-active').each(function (i, obj) {
            $(obj).removeClass('menu-active');
            $(obj).addClass('menu');
            $(obj).find('.menu-icon-active').addClass('menu-icon');
            $(obj).find('.menu-icon').removeClass('menu-icon-active');
            $(obj).find('.menu-title-active').addClass('menu-title');
            $(obj).find('.menu-title').removeClass('menu-title-active');
        });

        if ($(this).prop('id') != 'logout') {
            $(this).addClass('menu-active');
            $(this).removeClass('menu');
            $(this).find('.menu-icon-active').removeClass('menu-icon');
            $(this).find('.menu-icon').addClass('menu-icon-active');
            $(this).find('.menu-title').addClass('menu-title-active');
            $(this).find('.menu-title-active').removeClass('menu-title');
            loadModule($(this).attr('id'));
        }
    });

    $(".expand-sidebar").click(function () {
        if ($(".menus-heading").css("display") == 'none') {
            $(".container-main").css("margin-left", "calc(260px + 20px - 174px + 174px)");
            $(".container-main").css("width", "calc(100vw - 246px - 54px)");
            $(".container-nav").css("margin-left", "calc(260px - 174px + 174px)");
            $(".container-nav").css("width", "calc(100vw - 260px)");
        } else if (!$(".sidebar").hasClass(".sidebar-minimize")) {
            $(".container-main").css("margin-left", "calc(260px + 20px - 174px)");
            $(".container-main").css("width", "calc(100vw - 126px)");
            $(".container-nav").css("margin-left", "calc(260px - 174px)");
            $(".container-nav").css("width", "calc(100vw - 86px)");
        }
        $(".sidebar").toggleClass("sidebar-minimize");
    });

    // showFlashMassage();
    // closeFlashMessage();
});

function showFlashMassage() {
    $('.container-nav').click(function () {
        console.log('luar');
        $.each($('#inner-message.hide'), function (indexInArray, obj) {
            if ($(obj).hasClass('hide')) {
                // $(obj).css('display', 'block');
                $(obj).removeAttr('style');
                $(obj).removeClass('hide');
                $(obj).addClass('show');
                // $(obj).css('display', );
                setTimeout(() => {
                    $(obj).removeClass('show');
                    $(obj).addClass('hide');
                    setTimeout(() => {
                        $(obj).css('display', 'none');
                    }, 1000);
                }, 5000);
            }
        })
    });
}

function flashMessage(status, message, action = {}) {
    type = {
        'success': 'success',
        'failed': 'danger'
    };
    obj = $('#inner-message.hide[message="'+type[status]+'"]');
    $(obj).removeAttr('style');
    $(obj).removeClass('hide');
    $(obj).addClass('show');
    $(obj).find('h4').html(action[status]);
    $(obj).find('p.content-message').html(message);
    setTimeout(() => {
        $(obj).removeClass('show');
        $(obj).addClass('hide');
        setTimeout(() => {
            $(obj).css('display', 'none');
        }, 1000);
    }, 5000);
}

function closeFlashMessage(obj) {
    $(obj).addClass('hide');
    $(obj).removeClass('show');
    setTimeout(() => {
        $(obj).css('display', 'none');
    }, 1000);
}