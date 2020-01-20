Since laravel does not support multiple webpack configs and this
needs to be built specifically with the `target: node` webpack setting,
this folder must be built separately from the rest of the package.

In Vagrant, from within in the `resources/js/ssr` folder run the following to built and test:

```
npm install
npm run build
cd tests
composer install
php test.php
```

You should get rendered HTML output.

Make sure to commit the built `resources/js/ssr/dist/main.js` as part of this package.
