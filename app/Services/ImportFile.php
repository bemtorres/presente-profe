<?php

namespace App\Services;

use Illuminate\Http\Request;

class ImportFile {
  public static function save(
      Request $request,
      $inputName = 'image',
      $name = '',
      $folderSave = 'trash',
      $validate = false)
    {
      try {
        if ($validate) {
          $request->validate([
            $inputName => 'required|mimes::pdf,xlx,csv,xlsx,doc,docx,ppt,pptx|max:2048',
          ]);
        }

        $root = 'public/'.$folderSave;
        $file = $request->file($inputName);
        $filename = $name .'.'. $file->getClientOriginalExtension();
        $file->storeAs($root, $filename);

        return $folderSave.'/'.$filename;
      } catch (\Throwable $th) {
        return 400;
        // return $th;
      }
  }
}
