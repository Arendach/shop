<div class="select" style="height: 200px; margin-bottom: 16px;">
    @forelse($products as $product)
        <div data-value="{{ $product->id }}" class="option">
            {{ $product->name }}
        </div>
    @empty
    @endforelse
</div>