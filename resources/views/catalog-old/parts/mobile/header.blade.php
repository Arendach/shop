<style>
    .top-menu {
        margin-bottom: 10px;
    }

    .top-menu .switch-menu {
        vertical-align: middle;
    }

    .top-menu .switch-menu {
        color: #E31837;
        margin-left: 15px;
        font-size: 22px;
        display: inline-block;
    }

    .top-menu .cart-menu {
        font-size: 22px;
        color: #E31837;
        margin-right: 15px;
    }

    .top-menu .cart-menu i {
        color: #E31837;
    }

    .top-menu .logo-menu img {
        height: 22px;
        vertical-align: baseline;
    }

    .top-menu .logo-menu {
        margin-left: 10px;
        display: inline-block;
        vertical-align: bottom;
    }

    .search-block {
        margin: 0 15px;
    }

    .sub-menu {
        display: block;
        position: absolute;
        top: 36px;
        left: 0;
        background-color: white;
        z-index: 999;
        border: 1px solid black;
        width: 80%;
        height: calc(100% - 36px);
    }
</style>

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

    <div class="top-menu">
        <div class="pull-left">
            <div class="switch-menu" onclick="$('.sub-menu').toggle()">
                <i class="fa fa-bars"></i>
            </div>

            <div class="logo-menu">
                <img src="{{ asset('img/logo.png') }}" alt="Skyfire Logo">
            </div>
        </div>

        <div class="pull-right">
            <div class="cart-menu">
                <a href="{{ route('cart') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <b class="text-danger" id="cart_products_count">
                        {{ $cart_count_products }}
                    </b>
                </a>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

    <div class="search-block">
        <div class="input-group input-group-sm">
            <input class="form-control"
                   placeholder="@translate('Пошук товарів')"
                   id="search_string"
                   value="{{ $search_string ?? '' }}"
                   style="height: 30px">
            <div class="input-group-append">
                <button style="height: 30px" id="search_button" class="btn btn-danger" type="button">
                    @translate('Шукати')
                </button>
            </div>
        </div>
    </div>

    <div class="sub-menu" style="display: none">
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
            <div class="accordion" id="category-accordion">
                @foreach($categories as $item)
                    <div class="card">
                        <div class="card-header">
                            <span href="#cat-{{ $item->id }}" data-toggle="collapse">
                                {{ $item->name }}
                            </span>
                        </div>

                        <div class="collapse" id="cat-{{ $item->id }}" data-parent="#category-accordion">
                            <div class="card-body">
                                @foreach($item->child as $category_inner)
                                    <a href="{{ route('category.show', $category_inner->slug) }}">
                                        {{ $category_inner->name }}
                                    </a><br>
                                    @foreach($category_inner->links as $link)
                                        <a href="{{ $link->url }}">- {{ $link->name }}</a><br>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="right-block">
                @if(isuth())
                    <a href="{{ route('profile') }}">
                        <i class="fa fa-user"></i> @translate('Профіль')
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa fa-user"></i> @translate('Профіль')
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>