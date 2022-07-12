<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{   
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Food',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Travel',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Fashion',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Study',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Beauty',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Entertainment',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Business',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Others',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->category->insert($categories);
    }
}
