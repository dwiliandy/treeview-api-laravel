<?php

namespace Database\Seeders;

use App\Models\Folder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $root = Folder::create(['name' => 'Root']);

      $subFolder1 = Folder::create(['name' => 'Documents', 'parent_id' => $root->id]);
      $subFolder2 = Folder::create(['name' => 'Images', 'parent_id' => $root->id]);
      $subSub1 = Folder::create(['name' => 'Folder1', 'parent_id' => $subFolder1->id]);
      $subSub2 = Folder::create(['name' => 'Folder2', 'parent_id' => $subFolder1->id]);

      \App\Models\File::create(['name' => 'file1.txt', 'folder_id' => $subFolder1->id]);
      \App\Models\File::create(['name' => 'image1.jpg', 'folder_id' => $subFolder2->id]);
      \App\Models\File::create(['name' => 'image2.jpg', 'folder_id' => $subSub2->id]);
    }
}
