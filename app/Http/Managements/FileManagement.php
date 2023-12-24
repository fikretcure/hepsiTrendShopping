<?php

namespace App\Http\Managements;

use Illuminate\Support\Facades\Storage;


/**
 *
 */
class FileManagement
{


    /**
     * @param $old_path
     * @param $new_path
     * @return void
     */
    public function moveFile($old_path, $new_path): void
    {
        Storage::move($old_path, $new_path);
    }
}
