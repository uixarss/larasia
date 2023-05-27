<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ListNegaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function csv_to_array($filename='', $delimiter=',')
        {
            if(!file_exists($filename) || !is_readable($filename))
                return FALSE;

            $header = NULL;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
                {
                    if(!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }
            return $data;
        }

      

        $csvFile = public_path().'/data/country.csv';

        $country = csv_to_array($csvFile);
        // Insert Data to Database
        DB::table('list_negara')->insert($country);
    }
}
