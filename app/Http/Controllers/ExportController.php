<?php

namespace App\Http\Controllers;

use App\Services\ExportService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * @var ExportService
     */
    private $exportService;

    /**
     * ExportController constructor.
     * @param ExportService $exportService
     */
    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    /**
     * @param Request $request
     * @return BinaryFileResponse
     * @throws \Exception
     */
    public function index(Request  $request)
    {
        return $this->exportService->export($request->get('items'), $request->get('format'));
    }
}
