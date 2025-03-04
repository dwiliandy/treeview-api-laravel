<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;


Route::get('/folders', [FolderController::class, 'index']);
