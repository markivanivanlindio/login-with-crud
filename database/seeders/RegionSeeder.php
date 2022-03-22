<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
        $csvFile = fopen(base_path("database/data/regions.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Region::create([
                    "id" => $data['0'],
                    "name" => $data['1']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    
    }
}
