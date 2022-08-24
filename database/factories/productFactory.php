<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "admin_id" => 1,
            "name" => $this->faker->name(),
            "price" => $this->faker->numberBetween(1, 666),
            "category_id" => $this->faker->numberBetween(8, 14),
            "image" => "productscontrollrt/defaut.jpg",
            "sizes" => "12 inch,10 inch",
            "colors" => "0xffEF0000,0xff00FF24,0xffE7CB23",
            "available" => "1",
            "desc_en" => "English Desc  English Desc English Desc English Desc English Desc English Desc English Desc English Desc English Desc " ,
            "desc_ar" => "الوصف بالعربيةالوصف بالعربية الوصف بالعربية الوصف بالعربية الوصف بالعربية الوصف بالعربية الوصف بالعربية",
        ];
    }
}
