$(document).ready(function () {
    $('.categories').hover(function () {
        $('.category-list').css('display', 'block');
    }, function () {
        $('.category-list').hide();
        $('.category-inner').css('display', 'none');
    });

    $('.category-item').hover(function () {
        let id = $(this).data('id');
        $('.category-inner').css('display', 'none');
        $('.category-inner[data-id="' + id + '"]').css('display', 'block');
    });

    $('.category-inner, .category-item').hover(function () {
        let id = $(this).data('id');

        $('.category-item[data-id="' + id + '"]').find('a')
            .css('font-weight', 'bolder')
            .css('border-top', '1px solid #eee')
            .css('border-bottom', '1px solid #eee');
    }, function () {
        let id = $(this).data('id');

        $('.category-item[data-id="' + id + '"]').find('a')
            .css('font-weight', 'normal')
            .css('border-top', 'none')
            .css('border-bottom', 'none');
    });

    $('.categories').mousemove(function () {
        var content = $('.category-list');
        var sidebar = $('.category-inner:visible');
        var getContentHeight = content.outerHeight();
        var getSidebarHeight = sidebar.outerHeight();

        if (getContentHeight > getSidebarHeight) {
            sidebar.css('height', getContentHeight);
        }
        if (getSidebarHeight > getContentHeight) {
            content.css('height', getSidebarHeight);
        }
    });


});


$(document).on('mouseenter', '.drop-down', function () {
    let id = $(this).data('id');

    $(this).children('a').addClass('drop-active');

    $('#' + id).show();
});


$(document).on('mouseleave', '.drop-down', function () {
    let id = $(this).data('id');

    $(this).children('a').removeClass('drop-active');

    $('#' + id).hide();
});

$(document).on('click', '#search_button', function (event) {
    event.preventDefault();

    let value = $('#search_string').val();

    window.location.href = JS.searchRoute + '/' + value;
});