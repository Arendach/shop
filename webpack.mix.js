const mix = require('laravel-mix');
require('laravel-mix-alias');

mix.options({
    processCssUrls: false,
    terser: {extractComments: false,},
})

mix.alias({
    '@': 'resources/js',
    'Api': 'resources/js/helpers/api.js',
})

mix.js('resources/js/cart.js', 'public/js')
    .js('resources/js/drop-menu.js', 'public/js')
    .js('resources/js/components/checkout-form/main.js', 'public/js/checkout.js')
    .js('resources/js/components/product/product.js', 'public/js/product.js')
    .js('resources/js/customer/login.ts', 'public/js/customer.js')
    .js('resources/js/app.js', 'public/js/app.js')
    .js('resources/js/components/category-filter/main.js', 'public/js/category-filter.js')
    .js('resources/js/components/category/main.js', 'public/js/main-category.js')
    .sass('resources/sass/custom.scss', 'public/css/custom.css')
    .sass('resources/sass/drop-menu.scss', 'public/css/drop-menu.css')
    .sass('resources/sass/checkout.scss', 'public/css/checkout.css')
    .sass('resources/sass/pages/product.scss', 'public/css/product.css')
    .styles([
        'public/catalog/css/bootstrap.custom.min.css',
        'public/catalog/css/custom.css',
        'public/css/custom.css',
        'public/catalog/css/style.css',
        'public/catalog/css/toastr.css',
    ], 'public/catalog/css/app.css')


    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: "ts-loader",
                    exclude: /node_modules/
                }
            ]
        },
        resolve: {
            extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
        }
    })

mix.version()