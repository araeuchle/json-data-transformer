<?php
namespace App\Services;

use App\DTO\Address;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportService
{
    /**
     * @var string
     */
    private $exportPath;

    public function __construct()
    {
        $this->exportPath = storage_path('exports');

        if (!is_dir($this->exportPath)) {
            mkdir($this->exportPath, 0700);
        }
    }

    /**
     * @param array $items
     * @param string $format
     */
    public function export(array $items, string $format = 'csv')
    {
        $method = $format . 'Export';

        if (!method_exists($this, $method)) {
            throw new \Exception(sprintf('Method %s is not implemented.', $method));
        }

        return $this->$method($items);
    }

    private function csvExport($items)
    {
        $filename = $this->exportPath . DIRECTORY_SEPARATOR .  'data.csv';

        $fileHandle = fopen($filename, 'w');
        $majorRow = [
            'place_listing'
        ];

        fputcsv($fileHandle, $majorRow, ';');

        $headerColumns =  [
            'ID',
            'post_title',
            'post_author',
            'post_content',
            'post_category',
            'post_tags',
            'post_type',
            'post_status',
            'featured',
            'video',
            'street',
            'city',
            'region',
            'country',
            'zip',
            'latitude',
            'longitude',
            'business_hours',
            'phone',
            'email',
            'website',
            'twitter',
            'facebook'
        ];

        fputcsv($fileHandle, $headerColumns, ';');

        foreach ($items as $item) {

            $address = new Address();
            $address->createFromData($item['Address']);

            $column = [
                '',
                $item['Title'] ?? '',
                '1',
                '',
                '1',
                $address->getRegion() ?? '',
                'gd_place',
                'publish',
                '0',
                '',
                $address->getStreet() ?? '',
                $address->getCity() ?? '',
                $address->getRegion() ?? '',
                $address->getCountry() ?? '',
                $address->getZip() ?? '',
                $item['latitude'] ?? '',
                $item['longitude'] ?? '',
                $item['Open_Time'] ?? '',
                $item['Phone'] ?? '',
                '',
                $item['Website'] ?? '',
                '',
                ''
            ];

            fputcsv($fileHandle, $column, ';');
        }

        fclose($fileHandle);

        $headers = [
            'Content-Type' => 'text/csv'
        ];

        return response()->download($filename, 'export.csv', $headers);
    }

    private function jsonExport($items)
    {
        $items = json_encode($items, JSON_PRETTY_PRINT);
        $filename = $this->createExportFile($items, 'json');
        $headers = [
            'Content-Type' => 'application/json'
        ];

        return response()->download($filename, 'export.json', $headers);
    }

    private function createExportFile($items, $format)
    {
        $filename = $this->exportPath . DIRECTORY_SEPARATOR . 'export.' . $format;

        file_put_contents($filename, $items);

        return $filename;
    }
}
