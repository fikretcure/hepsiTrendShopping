<?php

namespace App\Http\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;

/**
 *
 */
class Service
{
    /**
     * @var String
     */
    public string $baseUrl;


    /**
     * @param string|null $method
     * @param string|null $path
     * @param string|null $file_path
     * @return JsonResponse
     */
    public function send(string $method = null, string $path = null, string $file_path = null): JsonResponse
    {
        $path = $path ?? request()->path();
        $method = $method ?? request()->getMethod();
        if ($file_path) {
            $response = Http::attach('file', file_get_contents($file_path), 'file.file')->withHeaders([
                'content-ype' => 'multipart/form-data',
                'X-USER-ID' => request()->header('X-USER-ID'),
                'X-USER-EMAIL' => request()->header('X-USER-EMAIL'),
            ])->withToken(request()->bearerToken())->accept('application/json')->{$method}($this->baseUrl . $path, request()->all());

            Process::run('rm -rf ' . $file_path);
        } else {
            $response = Http::withHeaders([
                'X-USER-ID' => request()->header('X-USER-ID'),
                'X-USER-EMAIL' => request()->header('X-USER-EMAIL'),
            ])->withToken(request()->bearerToken())->accept('application/json')->{$method}($this->baseUrl . $path, request()->all());
        }

        return response()->json($response->json(), $response->status());
    }
}
