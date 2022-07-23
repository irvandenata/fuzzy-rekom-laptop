<?php

namespace Tests\Feature;

use App\Models\Kelurahan;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagePasienTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

//     /** @test */

    public function all_user_can_create_a_pasien()
    {

        $this->actingAs($this->user)->get('/pasien');
        $kelurahan = Kelurahan::factory()->create();
        $response = $this->actingAs($this->user)
            ->json("POST", '/pasien', [
                '_token' => csrf_token(),
                 'id' => '2207000001',
                'nama_pasien' => 'aman',
                'alamat' => 'jeruju',
                'kelurahan_id' => $kelurahan->id,
                "no_telepon" => intval('089778797'),
                'rt' => 1,
                'rw' => 2,
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '19-12-1999',
            ]);
        $this->assertDatabaseHas('pasiens', [
            'nama_pasien' => 'aman',
            'alamat' => 'jeruju',
                'kelurahan_id' => $kelurahan->id,
                'no_telepon' => intval('089778797896'),
                'rt' => 1,
                'rw' => 2,
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '19-12-1999',
        ]);

    }

    /** @test */

    public function all_user_can_edit_existing_pasien()
        {
         $this->actingAs($this->user)->get('/pasien');
        $kelurahan = Kelurahan::factory()->create();

         $pasien = Pasien::factory()->create();
            $response = $this->actingAs($this->user)
                ->json("PUT", '/pasien/' . $pasien->id, [
                'nama_pasien' => 'aman',
                'alamat' => 'jeruju',
                'kelurahan_id' => $kelurahan->id,
                'no_telepon' => intval('089778797896'),
                'rt' => 1,
                'rw' => 2,
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '19-12-1999',
                ]);

                // dd($response);
            // check perubahan data di table pasien
            $this->assertDatabaseHas('pasiens', [
                'id' => $pasien->id,
               'nama_pasien' => 'aman',
            ]);
        }

        public function all_user_can_delete_existing_pasien()
    {

       $this->actingAs($this->user)->get('/pasien');
        $pasien = Pasien::factory()->create();

// pasien delete request
        $this->post('/pasien/' . $pasien->id, [
            '_method' => 'DELETE',
        ]);

// check data di table pasien
        $this->assertDatabaseMissing('pasiens', [
            'id' => $pasien->id,
            'nama_pasien' => $pasien->nama_pasien,
        ]);

    }

}
