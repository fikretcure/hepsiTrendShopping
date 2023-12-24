<?php

namespace App\Http\Controllers;


use App\Http\Managements\ExitManagement;
use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class FileController extends Controller
{
    /**
     * @param FileUploadRequest $request
     * @return JsonResponse
     */
    public function upload(FileUploadRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $name = $file->hashName();
        $request->file('file')->store('public/file');
        return ExitManagement::ok($name);
    }

}
