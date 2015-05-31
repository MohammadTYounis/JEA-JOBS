<?php

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        $categories = [
            [
                'id'          => '1',
                'name'        => 'الهندسة المدنية',
                'slug'        => 'views',
                'description' => 'الهندسة المدنية',
                'order'       => '1',
            ],
            [
                'id'          => '2',
                'name'        => 'الهندسة المعمارية',
                'slug'        => 'eloquent',
                'description' => 'الهندسة المعمارية',
                'order'       => '2',
            ],
            [
                'id'          => '3',
                'name'        => 'الهندسة الكيماوية',
                'slug'        => 'kemea',
                'description' => 'الهندسة الكيماوية',
                'order'       => '3',
            ],
            [
                'id'          => '4',
                'name'        => 'الهندسة الكهربائية',
                'slug'        => 'electronic',
                'description' => 'الهندسة الكهربائية',
                'order'       => '4',
            ],
            
        ];

        DB::table('categories')->insert($categories);
        DB::table('category_trick')->insert([
            [ 'category_id' => '2', 'trick_id' => '1' ],
            [ 'category_id' => '1', 'trick_id' => '2' ],
            [ 'category_id' => '2', 'trick_id' => '3' ],
        ]);
    }
}


