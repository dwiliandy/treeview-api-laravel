<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Folder extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'parent_id'];

  public function subFolders()
  {
      return $this->hasMany(Folder::class, 'parent_id')->with('subFolders', 'files');
  }

  public function files()
  {
      return $this->hasMany(File::class);
  }
}
