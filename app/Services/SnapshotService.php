<?php
namespace App\Services;

use App\Http\Requests\SnapshotRequest;
use Illuminate\Http\Request;

class SnapshotService
{
    /**
     * @var string
     */
    private $storagePath;

    public function __construct()
    {
        $this->storagePath = storage_path('savings');

        if (!is_dir($this->storagePath))  {
            mkdir($this->storagePath, 0700);
        }
    }

    /**
     * @param SnapshotRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(SnapshotRequest $request)
    {
        $data = json_encode($request->validated(), JSON_PRETTY_PRINT);
        $result = file_put_contents($this->generateFileName(), $data);

        return response()->json([
            'status' => $result > 0
        ]);
    }

    /**
     * @return string
     */
    private function generateFileName()
    {
        $now = now();

        return  $this->storagePath . DIRECTORY_SEPARATOR .  $now->format('d.m.Y_H:i:s') . '.json';
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        return response()->json([
            'status' => true,
            'data' => $this->listFiles()
        ]);
    }

    /**
     * @param string $filename
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(string $filename)
    {
        $file = $this->storagePath . DIRECTORY_SEPARATOR . $filename;

        if (!is_file($file))  {
            return response()->json([
                'status' => false
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => json_decode(file_get_contents($file), true)
        ]);
    }

    /**
     * @param string $filename
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $filename)
    {
        $file = $this->storagePath . DIRECTORY_SEPARATOR . $filename;

        if (!is_file($file))  {
            return response()->json([
                'status' => false
            ]);
        }

        $result = unlink($file);

        return response()->json([
            'status' => $result,
            'data' => $this->listFiles()
        ]);
    }

    private function listFiles()
    {
        return array_slice(scandir($this->storagePath), 2);
    }

    public function deleteAll()
    {
        $files = $this->listFiles();

        if (count($files) > 0) {
            foreach ($files as $file) {
                unlink($this->storagePath . DIRECTORY_SEPARATOR . $file);
            }
        }

        $checkFileCount = count(array_slice(scandir($this->storagePath), 2));

        return response()->json([
            'status' => $checkFileCount === 0
        ]);
    }
}
