$(document).ready(function () {
    function slider_init() {
        let items = $('.slider-item');
        let item_active = $('.slider-active');
        let item_active_index = item_active.attr('id').match(/[0-9]+/)[0];
        let items_count = items.length;
        let play = true;
        let vector = 'left';
        let width = $('.slider').innerWidth();

        $(window).resize(function () {
            width = $('.slider').innerWidth();
        });

        function slide() {
            $('.slider-arrow').attr('disabled', 'disabled');

            let delete_property = vector == 'left' ? 'right' : 'left';
            // якщо прокрутка вимкнена то припиняє мо функцію
            // if (!play) return;

            $('.slider-item').css(delete_property, '');

            // опускаємо всі окрім активного до низу
            $('.slider-item:not(.slider-active)').css(vector, (width - 50) + 'px');

            // анімація активного слайда
            let it = $('.slider-active')
                .animate({[vector]: '-' + width + 'px'}, {
                    duration: 350,
                    easing: 'linear'
                });

            // анімація наступного кадру
            $('#slider-item-' + item_active_index)
            // .css(delete_property, '')
                .animate({[vector]: '0px'}, {
                    duration: 300,
                    easing: 'linear'
                })
                .addClass('slider-active');

            // після таймера прибираємо у активного слайда клас активації
            setTimeout(function () {
                it.removeClass('slider-active');
                $('.slider-arrow').removeAttr('disabled');
            }, 350);


            $('.slider-point').removeClass('slider-point-active');

            $('.slider-point[data-id="' + item_active_index + '"]').addClass('slider-point-active');


        }

        $(document).on('click', '#slider-prev', function () {
            if ($(this).attr('disabled') == 'disabled') return;

            item_active_index = +item_active_index - 1;
            if (item_active_index <= 0) item_active_index = +items_count;
            vector = 'right';
            slide();
        });

        $(document).on('click', '#slider-next', function () {
            if ($(this).attr('disabled') == 'disabled') return;

            item_active_index = +item_active_index + 1;
            if (item_active_index > items_count) item_active_index = 1;
            vector = "left";
            slide();
        });

        $(document).on('click', '.slider-point', function () {
            let id = $(this).data('id');

            if ($(this).data('type') == 'handle') {
                if (id == 'pause') {
                    play = false;
                    $('.slider-point[data-id="pause"]').html('&#9654;');
                    $(this).data('id', 'play');
                } else {
                    play = true;
                    $('.slider-point[data-id="pause"]').html('&#10074;&#10074;');
                    $(this).data('id', 'pause');
                    item_active_index = +$('.slider-active').attr('id').match(/[0-9]+/)[0];
                }
            } else {
                if (item_active_index == id) return;

                if (item_active_index > id) vector = 'right'; else vector = 'left';

                item_active_index = +id;
                slide();
            }
        });

        setInterval(function () {
            if (play) {
                vector = "left";
                item_active_index = +item_active_index;
                item_active_index += 1;
                if (item_active_index > items_count) item_active_index = 1;
                slide();
            }
        }, 5000);
    }

    slider_init();

    function manufacturers_slider_init() {
        $(document).on('click', '.manufacturer-next', function () {
            let margin_left = $('.manufacturer-items').css('margin-left').replace(/px/, '');
            let container_width = $('.manufacturer-items').width();
            let new_value;
            let max_width = 0;

            $('.manufacturer').each(function () {
                max_width += $(this).width();
            });

            if (max_width - container_width <= Math.abs(margin_left) + container_width)
                new_value = -(+max_width - container_width) + 'px';
            else
                new_value = -(Math.abs(margin_left) + container_width) + 'px';

            $('.manufacturer-items').animate({"margin-left": new_value}, 200);
        });

        $(document).on('click', '.manufacturer-prev', function () {
            let margin_left = $('.manufacturer-items').css('margin-left').replace(/px/, '');
            let container_width = $('.manufacturer-items').width();
            let new_value;

            if (Math.abs(margin_left) - container_width < 0)
                new_value = 0 + 'px';
            else
                new_value = -(Math.abs(margin_left) - container_width) + 'px';

            $('.manufacturer-items').animate({"margin-left": new_value}, 200);
        });
    }

    manufacturers_slider_init();

});