<div class="modal fade" tabindex="-1" id="modal">
    <div class="modal-dialog {{ isset($modal_size) ? 'modal-' . $modal_size : '' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? 'Enter Title' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@yield('script')