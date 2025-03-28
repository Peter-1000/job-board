<?php

use App\Http\Controllers\{
    OurJobsController,
    JobAttributesController,
    LanguagesController,
    CountriesController,
    StatesController,
    CitiesController,
    CategoriesController,
};
use Illuminate\Support\Facades\Route;

// Our Jobs Routes
Route::resource('our-jobs', OurJobsController::class);
Route::get('job-attributes', JobAttributesController::class)->name('job-attributes');

// Languages Routes
Route::resource('languages', LanguagesController::class);

// Categories Routes
Route::resource('categories', CategoriesController::class);

// Countries Routes
Route::resource('countries', CountriesController::class);

// States Routes
Route::resource('states', StatesController::class);

// Cities Routes
Route::resource('cities', CitiesController::class);
