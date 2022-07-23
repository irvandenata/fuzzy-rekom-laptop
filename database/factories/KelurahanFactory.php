<?php

namespace Database\Factories;

use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelurahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_kelurahan' => 'Tebas Sungai',
            'kecamatan_id' => function () {
                return Kecamatan::factory()->create()->id;
            },
        ];
    }
}
