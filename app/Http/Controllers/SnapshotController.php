<?php

namespace App\Http\Controllers;

use App\Http\Requests\SnapshotRequest;
use App\Services\SnapshotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SnapshotController extends Controller
{
    /**
     * @var SnapshotService
     */
    private $snapshotService;

    /**
     * SaveController constructor.
     * @param SnapshotService $snapshotService
     */
    public function __construct(SnapshotService $snapshotService)
    {
        $this->snapshotService = $snapshotService;
    }

    /**
     * @param SnapshotRequest $request
     * @return JsonResponse
     */
    public function add(SnapshotRequest $request)
    {
        return $this->snapshotService->save($request);
    }

    /**
     * @return JsonResponse
     */
    public function list()
    {
        return $this->snapshotService->list();
    }

    /**
     * @param string  $filename
     * @return JsonResponse
     */
    public function restore(string $filename)
    {
        return $this->snapshotService->restore($filename);
    }

    /**
     * @param string $filename
     * @return JsonResponse
     */
    public function delete(string $filename)
    {
        return $this->snapshotService->delete($filename);
    }

    /**
     * @return JsonResponse
     */
    public function deleteAll()
    {
        return $this->snapshotService->deleteAll();
    }
}
