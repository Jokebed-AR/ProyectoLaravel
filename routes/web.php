<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Brand;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return redirect('/');
});


Route::get('/', 'HomeController@index');

Route::get('/nosotros', 'AboutUsController@index');
Route::get('/contacto', 'ContactController@index');
Route::post('/contacto', 'ContactController@create');
Route::post('/newsletter', 'NewsletterController@create');
Route::post('/upload', function() {
    request()->file('file')->store(
        'my-file','s3'
    );
});
Route::get('/contacto-exitoso/{product}', 'ContactController@success');
Route::get('/contacto-exitoso', 'ContactController@success');
Route::get('/subscripcion-exitosa', 'NewsletterController@success');
Route::get('/subscripcion-previa', 'NewsletterController@failure');

Route::post('/catalogo', 'ApiCatalogController@create');


Route::prefix('/productos')->group(function () {
    Route::get('/{clasification}', 'ProductsListController@clasification');

    Route::get('/detalle/{category}/{subcategory}/{product}', 'ProductsListController@detail');

    Route::get('{classification}/{category}/{subcategory}/{brand}', 'ProductsListController@productsFilterWithClassification');

    Route::get('{category}/{subcategory}/{brand}', 'ProductsListController@productsFilter');

    // Route::get('/', 'ProductsListController@index');
});

Route::get('/documentos-legales/{documento}', 'HomeController@legalDocuments');


Route::get('/landing/{seoName}', 'LandingController@show');
