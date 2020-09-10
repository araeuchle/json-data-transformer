<?php
namespace App\Services;

use App\Http\Requests\SnapshotRequest;

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

    public function list()
    {
        return response()->json([
            'savings' => array_slice(scandir($this->storagePath), 2)
        ]);
    }


}
