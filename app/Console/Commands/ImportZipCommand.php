<?php

namespace App\Console\Commands;

use App\ZipMapping;
use Illuminate\Console\Command;

class ImportZipCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:zip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Helper command to import zip with states';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = base_path('data/zuordnung_plz_bundesland.csv');

        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $zipMapping = new ZipMapping();
                $zipMapping->zip = $data[0];
                $zipMapping->state = $data[1];
                $zipMapping->save();
            }

            fclose($handle);
        }

        return 0;
    }
}
