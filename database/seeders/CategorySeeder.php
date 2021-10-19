<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('www.themealdb.com/api/json/v1/1/categories.php');

        foreach ($response->json()['categories'] as $a) {
            DB::table('categories')->insert([
                'category' => $a['strCategory']
            ]);
        }
    }
}
