<?php

use Illuminate\Support\Facades\Route;
use App\Utilities\MarkdownHelper;

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

Route::get('/', function () {
    return view('markdown');
});

Route::post('/', function () {
    $markdownData = request('markdown');
    // don't use built-in laravel markdown function
    //$data = \Illuminate\Support\Str::of($markdownData)->markdown();
    //return ['html' => $data->value(), 'encoded_html' => htmlspecialchars($data->value())];
    $html = MarkdownHelper::toHtml($markdownData);
    // return both raw html and encoded html (encoded html will show as html code on the page)
    return ['html' => $html, 'encoded_html' => htmlspecialchars($html)];
});
