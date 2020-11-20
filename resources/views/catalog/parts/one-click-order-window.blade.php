<!-- Modal One click order-->
<div class="modal fade" id="one-click-order-window" tabindex="-1" role="dialog" aria-labelledby="one-click-order-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="one-click-order-title">@translate('Замовлення в 1 клік')</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-one-click-order">
                    <div class="form-group">
                        <label for="name-label">@translate('Ім\'я')</label>
                        <input type="text" class="form-control" id="name-label" name="name">
                    </div>
                    <div class="form-group">
                        <label for="phone-label">@translate('Телефон')</label>
                        <input type="text" class="form-control" id="phone-label" name="phone" placeholder="050-111-11-11" data-mask="phone">
                    </div>
                    <input type="hidden" value="0" name="product_id" id="product_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="make-one-click-order">@translate('Замовити')</button>
            </div>
        </div>
    </div>
</div>