<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 💡 1〜5のカテゴリIDをランダムに割り振ります
            'categry_id' => $this->faker->numberBetween(1, 5),
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            // 💡 1:男性 2:女性 3:その他 をランダムに割り振ります
            'gender'     => $this->faker->numberBetween(1, 3),
            'email'      => $this->faker->unique()->safeEmail(),
            // 💡 11桁の半角数字の電話番号を生成します
            'tel'        => $this->faker->numerify('###########'),
            'address'    => $this->faker->address(),
            'building'   => $this->faker->secondaryAddress(),
            // 💡 1970年〜2010年生まれのランダムな生年月日を生成します
            'birth_date' => $this->faker->dateTimeBetween('-56 years', '-16 years')->format('Y-m-d'),
            'detail'     => $this->faker->realText(50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
