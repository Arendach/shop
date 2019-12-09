<h3>Контакти</h3>

<form data-type="ajax"
      data-success-driver="toastr"
      data-error-driver="toastr"
      data-url="{{ route('admin.post', ['orders', 'default', 'update']) }}">

    <input type="hidden" name="id" value="{{ $order->id }}">

    <div class="form-group">
        <label>@lang('order.name')</label>
        <input name="name" value="{{ $order->name }}" class="form-control">
    </div>
    
    <div class="form-group">
        <label>@lang('order.phone')</label>
        <input name="phone" value="{{ $order->phone }}" class="form-control">
    </div>
    
    <div class="form-group">
        <label>@lang('order.email')</label>
        <input name="email" value="{{ $order->email }}" class="form-control">
    </div>
    
    <div class="form-group">
        <button class="btn btn-outline-primary">
            @lang('common.save')
        </button>
    </div>
    
</form>