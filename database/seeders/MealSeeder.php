<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //All categories for category seeder
        $categories = DB::table('categories')->select('category')->get();
        $mealsIds = [];


        foreach ($categories as $category) {
            //Geting all meals per category & push Id of meal to $mealsIds
            $responseCategory = Http::get('www.themealdb.com/api/json/v1/1/filter.php?c=' . $category->category);

            foreach ($responseCategory->json()['meals'] as $meal) {
                array_push($mealsIds, $meal['idMeal']);
            }
        }


        // All categories with id
        $temp = collect(Category::pluck('id', 'category'));

        // For every meal(id)  inserting to DB & saving image
        foreach (array_slice($mealsIds, 0, 100) as $meal) {
            $responseMeal = Http::get('www.themealdb.com/api/json/v1/1/lookup.php?i=' . $meal);
            $responseMeal = $responseMeal->json()['meals'][0];

            //get immage extention & new imageName 
            $imageExtention = substr($responseMeal['strMealThumb'], strrpos($responseMeal['strMealThumb'], '.') + 1);
            $newImageName = time() . '-' . str_replace(" ", "-", $responseMeal['strMeal']) . '.' . $imageExtention;

            // Save image
            $this->grab_image($responseMeal['strMealThumb'], public_path('storage/images/') . $newImageName);

            DB::table('meals')->insert([
                'name' => $responseMeal['strMeal'],
                'slug' => Str::slug($responseMeal['strMeal'], '-'),
                'category_id' => $temp->toArray()[$responseMeal['strCategory']],
                'area' => $responseMeal['strArea'],
                'instructions' => $responseMeal['strInstructions'],
                'image' => $newImageName,
                'url' => $responseMeal['strYoutube']
            ]);
        }
    }


    function grab_image($url, $saveto)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $raw = curl_exec($ch);
        curl_close($ch);
        if (file_exists($saveto)) {
            unlink($saveto);
        }
        $fp = fopen($saveto, 'x');
        fwrite($fp, $raw);
        fclose($fp);
    }
}
