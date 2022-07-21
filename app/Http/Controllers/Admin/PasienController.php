<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Pasien::latest()->with('kelurahan')->get();

            return DataTables::of($items)
                ->addColumn('kelurahan', function ($item) {
                    return $item->kelurahan->nama_kelurahan . " - Kec." . $item->kelurahan->kecamatan->nama_kecamatan . ' - Kab/Kota.' . $item->kelurahan->kecamatan->kota->nama_kota;
                })
                ->addColumn('rtrw', function ($item) {
                    return $item->rt . "/" . $item->rw;
                })
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fas fa-pencil-alt text-white    "></i></span></a>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['title'] = "Data Pasien";
        $data['kelurahan'] = Kelurahan::orderBy('nama_kelurahan')->get();
        return view('admin.pasien.index', $data);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $v = Validator::make($request->all(), [
                'nama_pasien' => 'required|max:255',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'no_telepon' => 'required',
                'tanggal_lahir' => 'required',
                'kelurahan_id' => 'required',
            ]);
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            $latest = Pasien::where('id', 'like', strval(Carbon::now()->format('ym')) . '%')->orderByDesc('id')->first();

            $latest = intval(str_replace('0', '', substr($latest->id, 4)));
            $id = str_pad(($latest + 1), 6, '0', STR_PAD_LEFT);

            $pasien = new Pasien();
            $pasien->id = Carbon::now()->format('ym') . $id;
            $pasien->nama_pasien = $request->nama_pasien;
            $pasien->kelurahan_id = $request->kelurahan_id;
            $pasien->alamat = $request->alamat;
            $pasien->rt = $request->rt;
            $pasien->rw = $request->rw;

            $pasien->no_telepon = $request->no_telepon;
            $pasien->tanggal_lahir = $request->tanggal_lahir;
            $pasien->jenis_kelamin = $request->jenis_kelamin;
            $pasien->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "Data Pasien Berhasil dibuat !", "data" => $pasien], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasien $pasien)
    {
        return $pasien;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasien $pasien)
    {
        try {
            $v = Validator::make($request->all(), [
                'nama_pasien' => 'required|max:255',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'no_telepon' => 'required',
                'tanggal_lahir' => 'required',
                'kelurahan_id' => 'required',
            ]);
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            $pasien->nama_pasien = $request->nama_pasien;
            $pasien->kelurahan_id = $request->kelurahan_id;
            $pasien->alamat = $request->alamat;
            $pasien->rt = $request->rt;
            $pasien->rw = $request->rw;
            $pasien->no_telepon = $request->no_telepon;
            $pasien->tanggal_lahir = $request->tanggal_lahir;
            $pasien->jenis_kelamin = $request->jenis_kelamin;
            $pasien->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "Data Pasien Berhasil diubah !", "data" => $pasien], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien)
    {
        try {
            $pasien->delete();
            return response()->json(['message' => "Data Kecamatan Berhasil dihapus !"], 200);
        } catch (\Throwable $th) {
            return response()->json('Terjadi Kesalahan !', 500);
        }

    }
}
