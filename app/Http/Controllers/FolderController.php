<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
   public function index(){
    $folders = Folder::with(['subFolders', 'files'])->whereNull('parent_id')->get();
    return response()->json($folders);
   }
}
