const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .ts('resources/js/completedExams.ts', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       //
   ]);
