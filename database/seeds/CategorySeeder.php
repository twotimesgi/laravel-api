<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Altro',
            ],
            [
                'name' => 'Cinema',
            ],
            [
                'name' => 'Viaggi',
            ],
            [
                'name' => 'Intrattenimento',
            ],
            [
                'name' => 'Tecnologia',
            ],
            [
                'name' => 'Sport',
            ],
            [
                'name' => 'Cultura',
            ],
            [
                'name' => 'Casa',
            ],
            [
                'name' => 'Cucina',
            ],
            [
                'name' => 'Arte',
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
