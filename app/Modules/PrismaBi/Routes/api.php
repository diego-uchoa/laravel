<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/prisma-bi', function (Request $request) {
    // return $request->prisma-bi();
})->middleware('auth:api');



Route::post('/prisma-bi/pdf/{dados?}',['as' => 'pdf.exportar', 'uses' => 'PdfController@exportar'])->middleware('cors');

Route::get('/prisma-bi/pdfTeste',['as' => 'pdf.get', 'uses' => 'PdfController@exportarTeste'])->middleware('cors');
