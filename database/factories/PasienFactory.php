<?php

namespace Database\Factories;

use App\Models\Kelurahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => '2207000001',
             'nama_pasien' => 'aman',
                'alamat' => 'jeruju',
                'kelurahan_id' => function () {
                return Kelurahan::factory()->create()->id;

            },
                'no_telepon' => intval('089778797896'),
                'rt' => 1,
                'rw' => 2,
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '19-12-1999',

        ];
    }
}
