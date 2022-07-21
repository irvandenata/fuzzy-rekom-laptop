<?php

namespace Tests\Feature;

use App\Models\Kota;
use App\Models\User;
use Tests\TestCase;

class ManageKotaTest extends TestCase
{
//     /**
    //      * A basic feature test example.
    //      *
    //      * @return void
    //      */

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

//     /** @test */

    public function admin_can_create_a_kota()
    {

        $this->actingAs($this->user)->get('/master-data/kota');
        $response = $this->actingAs($this->user)
            ->json("POST", '/master-data/kota', [
                '_token' => csrf_token(),
                'nama_kota' => 'Bandung',
            ]);
        $this->assertDatabaseHas('kotas', [
            'nama_kota' => 'Bandung',
        ]);

    }

    /** @test */

    public function admin_can_edit_existing_kota()
        {
         $this->actingAs($this->user)->get('/master-data/kota');
         $kota = Kota::factory()->create();
            $response = $this->actingAs($this->user)
                ->json("PUT", '/master-data/kota/' . $kota->id, [
                    'nama_kota' => "Kabupaten Bandung",
                ]);

                // dd($response);
            // check perubahan data di table kota
            $this->assertDatabaseHas('kotas', [
                'id' => $kota->id,
                'nama_kota' => 'Kabupaten Bandung',
            ]);
        }

        public function admin_can_delete_existing_kota()
    {

       $this->actingAs($this->user)->get('/master-data/kota');
        $kota = Kota::factory()->create();

// kota delete request
        $this->post('/master-data/kota/' . $kota->id, [
            '_method' => 'DELETE',
        ]);

// check data di table kota
        $this->assertDatabaseMissing('kotas', [
            'id' => $kota->id,
            'nama_kota' => $kota->nama_kota,
        ]);

    }



}
