const catalogPopList = $('.b-hbs-catalog-popup-list > li');

$('.b-hbs-catalog .b-hbs-catalog-toggler').click(function () {
    $('.b-sfilt-item-param-list label').popover('hide');
    if (!$('.b-hbs-catalog').hasClass('b-hbs-catalog-hover')) {
        $('.b-hbs-catalog').addClass('b-hbs-catalog-hover');
        $('.b-hbs-catalog').find('.b-hbs-catalog-popup').stop(true, true).slideDown(100);
    } else {
        $('.b-hbs-catalog').removeClass('b-hbs-catalog-hover');
        $('.b-hbs-catalog').find('.b-hbs-catalog-popup').stop(true, true).slideUp(100);
    }
    return false;
});

$('.b-hbs-catalog-backdrop').click(function () {
    $('.b-hbs-catalog').removeClass('b-hbs-catalog-hover').find('.b-hbs-catalog-popup').stop(true, true).slideUp(100);
    catalogPopList.removeClass('c-li-hover');
    $('body').removeClass('x-nav-visible-stay');
    return false;
});

catalogPopList.each(function () {
    if ($(this).find('.b-hbsc-popup').length != 0) {
        $(this).addClass('is-parent');
    }
});
let setTimeoutConst, setTimeoutConst2;
catalogPopList.mouseenter(function () {
    if (!$(this).hasClass('c-li-hover'))
    {
        var $this = $(this);
        var delayView = 500;
        if ($('.b-header-bot-side .b-hbs-catalog').hasClass('b-hbs-catalog-hover'))
        {
            delayView = 200;
        }
        setTimeoutConst = setTimeout(function () {
                catalogPopList.removeClass('c-li-hover');
                $this.addClass('c-li-hover');
            },
            delayView);
    }
}).mouseleave(function () {
    clearTimeout(setTimeoutConst);

});


$('.b-hbs-catalog-popup-list > li.is-parent').mouseenter(function () {
    if ($('.b-header').hasClass('b-header-catalog-fixed')) {
        setTimeoutConst2 = setTimeout(function () {
                $('.b-header-bot-side .b-hbs-catalog').addClass('b-hbs-catalog-hover');
            },
            500);
    }

}).mouseleave(function () {
    clearTimeout(setTimeoutConst2);
})