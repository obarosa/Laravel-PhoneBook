<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pri_nome' => $this->faker->firstName,
            'apelido' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'username' => $this->faker->name,
            'nmr_escritorio' => $this->faker->numerify('244######'),
            'nmr_telemovel' => $this->faker->numerify('91#######'),
            'favorito' => $this->faker->boolean,
            'usar_nmr_telemovel' => $this->faker->boolean,
            'usar_nmr_escritorio' => $this->faker->boolean,
        ];
    }
}
