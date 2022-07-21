<?php

namespace Database\Factories;

use App\Models\Kota;
use Illuminate\Database\Eloquent\Factories\Factory;

class KecamatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_kecamatan' => 'Tebas',
            'kota_id' => function () {
                return Kota::factory()->create()->id;
            },
        ];
    }
}
