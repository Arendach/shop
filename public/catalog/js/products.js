$(document).ready(function () {
    function heights() {
        $('.products .row').each(function () {
            let $row = $(this);
            let heights = [];
            let images_heights = [];
            $row.find('.product').each(function () {
                heights.push($(this).height());
                images_heights.push($(this).find('.product-image').height());
            });

            $row.find('.product').height(Math.max.apply(null, heights));
            $row.find('.product-image').height(Math.max.apply(null, images_heights));

            let $pb = $row.find('.product-bottom');
            let $pt = $row.find('.product-top');
            let $p = $row.find('.product');

            $row.find('.product').each(function () {
                let $p = $(this);
                let $pb = $p.find('.product-bottom');
                let $pt = $p.find('.product-top');

                $pb.css('margin-top', ($p.height() - $pt.height() - $pb.height()) + 'px');
            });
        });
    }

    setTimeout(heights, 1000);
    setTimeout(heights, 2000);
    setTimeout(heights, 3000);
    setTimeout(heights, 4000);
    setTimeout(heights, 5000);
    setTimeout(heights, 10000);
    setTimeout(heights, 15000);
    setTimeout(heights, 30000);
});