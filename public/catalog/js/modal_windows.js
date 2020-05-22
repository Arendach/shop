$(document).ready(function() {
    $('.grid_item').popover({
        placement: 'bottom',
    });
});

$('.click-video').on('click', function(){
    $('#video_title').html($(this).attr('data-video-title'));
    $('#iframe-video').attr('src', '//www.youtube.com/embed/' + $(this).attr('data-video-id'));
});

$('.click-one-click-order').on('click', function(){
    $('#product_id').val($(this).attr('data-id'));
});

$('#make-one-click-order').on('click', function(){

});