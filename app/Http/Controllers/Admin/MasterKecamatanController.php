<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterKecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Kecamatan::latest()->with('kota')->get();

            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fas fa-pencil-alt text-white    "></i></span></a>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['title'] = "Data Kecamatan";
        $data['kota'] = Kota::orderBy('nama_kota')->get();
        return view('admin.master_data.kecamatan.index', $data);
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
                'nama_kecamatan' => 'required|max:255',
                'kota_id' => 'required',
            ]);
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            $kecamatan = new Kecamatan();
            $kecamatan->nama_kecamatan = $request->nama_kecamatan;
            $kecamatan->kota_id = $request->kota_id;
            $kecamatan->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "Data Kecamatan Berhasil dibuat !", "data" => $kecamatan], 200);

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
    public function edit(Kecamatan $kecamatan)
    {
        return $kecamatan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        try {
            $v = Validator::make($request->all(), [
                'nama_kecamatan' => 'required|max:255',
                'kota_id' => 'required',
            ]);

            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            $kecamatan->nama_kecamatan = $request->nama_kecamatan;
            $kecamatan->kota_id = $request->kota_id;
            $kecamatan->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "Data Kecamatan Berhasil diubah!", "data" => $kecamatan], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        try {
            $kecamatan->delete();
            return response()->json(['message' => "Data Kecamatan Berhasil dihapus !"], 200);
        } catch (\Throwable $th) {
            return response()->json('Terjadi Kesalahan !', 500);
        }

    }
}
