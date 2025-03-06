<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;


Route::resource('/folders', 'App\Http\Controllers\FolderController');
