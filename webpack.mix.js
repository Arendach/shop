const mix = require('laravel-mix');

mix.js('resources/js/cart.js', 'public/js')
    .js('resources/js/customer/login.ts', 'public/js/customer.js')
    .js('resources/js/app.js', 'public/js/app.js')
    .sass('resources/sass/custom.scss', 'public/css/custom.css')


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
    });