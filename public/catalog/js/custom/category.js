function filterProducts() {
    ///////////////////////////////////////////////////////////
    let characteristics = {};

    $('.characteristics').each(function () {
        let $this = $(this);
        let id = $this.find('.characteristic_id').data('value');

        $this.find('.characteristic_flag:checked').each(function () {
            if (typeof characteristics['ch_' + id] == 'undefined')
                characteristics['ch_' + id] = [];

            characteristics['ch_' + id].push($(this).val());
        });
    });

    let p = '';

    if (Object.keys(characteristics).length > 0) {
        for (let id in characteristics) {
            for (let i in characteristics[id])
                p += id + '[]=' + encodeURI(characteristics[id][i]) + '&';
        }
    }
    /////////////////////////////////////////////////////////////

    if ($('#min_price').val() != min_price)
        p += 'min_price=' + $('#min_price').val() + '&';


    if ($('#max_price').val() != max_price)
        p += 'max_price=' + $('#max_price').val() + '&';
    ///////////////////////////////////////////////////////////

    let manufacturers = [];
    $('.manufacturer:checked').each(function () {
        manufacturers.push($(this).val());
    });

    if (manufacturers.length > 0)
        for (let i in manufacturers)
            p += 'manufacturers[]=' + manufacturers[i] + '&';

    ////////////////////////////////////////////////////////////
    p += 'order=' + $('.order').val() + '&';
    p += 'items=' + $('.items').val();

    window.location.href = '{{ url()->current() }}' + '?' + p;
}