<?php

use App\Models\District;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin', 301);

Route::get("/templates/{template}/{district}", function ($template, District $district) {
    return view("templates." . $template, ['district' => $district]);
})->name("templates");
