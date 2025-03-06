<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FolderController extends Controller
{
   public function index(){
    $folders = Folder::with(['subFolders', 'files'])->whereNull('parent_id')->get();
    return response()->json($folders);
   }

   public function show($id){
    $folder = Folder::where('id', $id)->with(['subFolders', 'files'])->get();
    return response()->json($folder);
   }

   public function store(Request $request)
   {
      $validator = Validator::make($request->all(),[
         'name' => 'required|string',
     ]);
     
     if($validator->fails()){
      return response()->json([
        'errors' => $validator->errors()
      ],422);   
     }
      if($request->type == 'file'){
         $data = File::create([
            'name' => $request->name,
            'folder_id' => $request->parent_id
         ]);
      }else{
         $data = Folder::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id
         ]);
      }

     return response()->json([
           'data' => $data
         ],201);
   }

   public function update(Request $request, $id)
   {
    $data = $request->type == 'file' ? File::find($id) : Folder::find($id);
    if($data == null){
      return response()->json([
        'message' => 'Data not found'
      ],404);
    }else{
      $data->update([
        'name' => $request->name
      ]);

      return response()->json([
        'data' => $data
      ],200);
    }
   }

   public function destroy($id)
   {
    $data = $_GET['type'] == 'file' ? File::find($id) : Folder::find($id);
    if($data == null){
      return response()->json([
        'message' => 'Data not found'
      ],404);
    }else{
      $data->delete();
      return response()->json([
        'message' => 'Data deleted'
      ],204);
    }
   }

  public function search(Request $request)
  {
    $query = $request->input('query');

    if (!$query) {
        return response()->json([
            'message' => 'Query parameter is required'
        ], 400);
    }

    $folders = Folder::where('name', 'LIKE', "%{$query}%")->with(['subFolders', 'files'])->get();
    $files = File::where('name', 'LIKE', "%{$query}%")->get();
    return response()->json([
        'folders' => $folders,
        'files' => $files
    ]);
  }
}
