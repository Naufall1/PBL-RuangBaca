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
        $(this).addClass('menu-active');
        $(this).removeClass('menu');
        $(this).find('.menu-icon-active').removeClass('menu-icon');
        $(this).find('.menu-icon').addClass('menu-icon-active');
        $(this).find('.menu-title').addClass('menu-title-active');
        $(this).find('.menu-title-active').removeClass('menu-title');
        loadModule($(this).attr('id'));
    });
});