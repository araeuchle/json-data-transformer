<?php
namespace App\Services;

use Illuminate\Http\Request;

class ExportService
{
    public function export(Request $request, $temp = false)
    {
        $convertedItems = $request->get('convertedItems');
        $items = $request->get('items');
        $currentIndex = $request->get('currentIndex');
    }

    private function jsonExport()
    {

    }

    private function csvExport()
    {

    }
}
