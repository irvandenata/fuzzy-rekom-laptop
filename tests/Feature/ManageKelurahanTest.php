<?php

namespace Tests\Feature;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageKelurahanTest extends TestCase
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

    public function admin_can_create_a_kelurahan()
    {

        $this->actingAs($this->user)->get('/master-data/kelurahan');
        $kecamatan = Kecamatan::factory()->create();
        $response = $this->actingAs($this->user)
            ->json("POST", '/master-data/kelurahan', [
                '_token' => csrf_token(),
                'nama_kelurahan' => 'Bandung',
                'kecamatan_id' => $kecamatan->id,
            ]);
        $this->assertDatabaseHas('kelurahans', [
            'nama_kelurahan' => 'Bandung',
                'kecamatan_id' => $kecamatan->id,

        ]);

    }

    /** @test */

    public function admin_can_edit_existing_kelurahan()
        {
         $this->actingAs($this->user)->get('/master-data/kelurahan');
                        $kecamatan = Kecamatan::factory()->create();


         $kelurahan = Kelurahan::factory()->create();
            $response = $this->actingAs($this->user)
                ->json("PUT", '/master-data/kelurahan/' . $kelurahan->id, [
                    'nama_kelurahan' => "Kabupaten Bandung",
                                    'kecamatan_id' => $kecamatan->id,

                ]);

                // dd($response);
            // check perubahan data di table kelurahan
            $this->assertDatabaseHas('kelurahans', [
                'id' => $kelurahan->id,
                'nama_kelurahan' => 'Kabupaten Bandung',
                                'kecamatan_id' => $kecamatan->id,

            ]);
        }

        public function admin_can_delete_existing_kelurahan()
    {

       $this->actingAs($this->user)->get('/master-data/kelurahan');

        $kelurahan = Kelurahan::factory()->create();

        // kelurahan delete request
        $this->post('/master-data/kelurahan/' . $kelurahan->id, [
            '_method' => 'DELETE',
        ]);

// check data di table kelurahan
        $this->assertDatabaseMissing('kelurahans', [
            'id' => $kelurahan->id,
            'nama_kelurahan' => $kelurahan->nama_kelurahan,
        ]);

    }
}
