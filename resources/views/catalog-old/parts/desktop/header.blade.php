<header>
    @if($banner->isActive())
        <div class="banner" style="background-color: {{ $banner->getColor() }}">
            <div class="container">
                <a href="{{ $banner->getUrl() }}">
                    <img style="width: 100%" src="{{ $banner->getPhotoUrl() }}">
                </a>
            </div>
        </div>
    @endif

    @include('catalog-old.parts.desktop.top_menu')

    <div class="social-links">
        <a style="color: #3962a9" href="#" class="social-link">
            <i class="fa fa-facebook"></i>
        </a>

        <a style="color: #CC6699" href="#" class="social-link">
            <i class="fa fa-instagram"></i>
        </a>

        <a style="color: #3399CC" href="#" class="social-link">
            <i class="fa fa-telegram"></i>
        </a>

        <a href="#" class="social-link">
            <i class="fa fa-vk"></i>
        </a>
    </div>

    <div class="container">
        <div class="bottom-menu">
            <div class="categories">
                <div class="category-title">
                    <i class="fa fa-list"></i> @translate('Категорії товарів')
                </div>

                <div class="category-list match-height">

                    @foreach($categories as $item)
                        <div class="category-item" data-id="{{ $item->id }}">
                            <a href="{{ route('category.show', $item->slug) }}">
                                {{ $item->name }}
                            </a>
                        </div>
                    @endforeach

                </div>

                <div class="category-inner-container">

                    @foreach($categories as $item)
                        <div class="category-inner" data-id="{{ $item->id }}">

                            <span class="white-bridge" style="top: {{ $loop->index * 34 }}px"></span>

                            @foreach($item->child as $category_inner)
                                <div class="category-inner-item">
                                    <a href="{{ route('category.show', $category_inner->slug) }}">
                                        {{ $category_inner->name }}
                                    </a><br>
                                    @foreach($category_inner->links as $link)
                                        <a href="{{ $link->url }}">- {{ $link->name }}</a><br>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="search-block">
                <div class="input-group input-group-sm">
                    <input class="form-control"
                           placeholder="@translate('Пошук товарів')"
                           id="search_string"
                           value="{{ $search_string ?? '' }}"
                           style="height: 30px">
                    <div class="input-group-append">
                        <button style="height: 30px" id="search_button" class="btn btn-outline-primary" type="button">
                            @translate('Шукати')
                        </button>
                    </div>
                </div>
            </div>

            <div class="right-block">
                @if(is_auth())
                    <a href="{{ route('profile') }}">
                        <i class="fa fa-user"></i> @translate('Профіль')
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa fa-user"></i> @translate('Профіль')
                    </a>
                @endif

                <a href="{{ route('cart') }}">
                    <i class="fa fa-shopping-cart"></i> @translate('Корзина') <b class="text-danger"
                                                                                 id="cart_products_count">
                        {{ $cart_count_products }}
                    </b>
                </a>
            </div>
        </div>
    </div>
</header>