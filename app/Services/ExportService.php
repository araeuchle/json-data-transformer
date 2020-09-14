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

    /**
     * @var string[]
     */
    private $headerColumns = [
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

    /**
     * ExportService constructor.
     */
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

    /**
     * @param $items
     * @return BinaryFileResponse
     */
    private function csvExport($items)
    {
        $filename = $this->exportPath . DIRECTORY_SEPARATOR .  'data.csv';

        $fileHandle = fopen($filename, 'w');

        fputcsv($fileHandle, ['place_listing'], ';');
        fputcsv($fileHandle, $this->headerColumns, ';');

        $rows = $this->createDataRows($items);

        if (count($rows) > 0) {
            foreach ($rows as $row) {
                fputcsv($fileHandle, $row, ';');
            }
        }

        fclose($fileHandle);

        $headers = [
            'Content-Type' => 'text/csv'
        ];

        return response()->download($filename, 'export.csv', $headers);
    }

    /**
     * @param $items
     * @return BinaryFileResponse
     */
    private function jsonExport($items)
    {
        $rows = $this->createDataRows($items, true);
        $filename = $this->exportPath . DIRECTORY_SEPARATOR . 'export.json';

        file_put_contents($filename, json_encode($rows, JSON_PRETTY_PRINT));

        $headers = [
            'Content-Type' => 'application/json'
        ];

        return response()->download($filename, 'export.json', $headers);
    }

    /**
     * @param $items
     * @param false $withHeader
     * @return array
     */
    private function createDataRows($items, $withHeader = false)
    {
        $rows = [];
        foreach ($items as $item) {

            $address = new Address();
            $address->createFromData($item['Address']);

            $values = [
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

            if ($withHeader) {
                $rows[] = array_combine($this->headerColumns, $values);
            } else {
                $rows[] = $values;
            }
        }

        return $rows;
    }
}
