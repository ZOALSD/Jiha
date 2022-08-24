<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Seeder;

class Categorises extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $devices = [
            'conditioners',
            'mixers',
            'washing',
            'refrigerators',
            'screens',
            'scree',
            'mixers2',

        ];
        foreach ($devices as $key => $value) {
            # code...
            category::create([
                'name' => $value,
                'admin_id' => 1,
                'parent_id' => null,
                'image' => 'categories/' . ($key + 1) . '.jpg',
            ]);
        }

        foreach ($devices as $key => $value) {
            # code...
            category::create([
                'name' => $value.'_sup',
                'admin_id' => 1,
                'parent_id' => $key + 1,
                'image' => 'categories/' . ($key + 1) . '.jpg',
            ]);
        }



    }
}
