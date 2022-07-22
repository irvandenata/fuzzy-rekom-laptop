<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterProductController extends Controller
{

    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Product::latest()->get();

            return DataTables::of($items)
                ->addColumn('image', function ($item) {
                    return $item->imagePath != null ? '<img src="/storage/' . $item->imagePath . '" width="200">' : 'Tidak Ada Gambar';
                })
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fas fa-pencil-alt text-white    "></i></span></a>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $data['title'] = "Data Produk";
        return view('admin.master_data.product.index', $data);
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
        $fileNameToStore = null;
        DB::beginTransaction();
        try {

            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'price' => 'numeric',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048|dimensions:min_width=100,max_width=1500',
                'description' => 'string',
            ]);
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = date('Y-m-d') . '-' . $this->generateRandomString(5) . '.' . time() . '.' . $extension;
                $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
                $fileNameToStore = 'image/' . $fileNameToStore;
            }

            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->imagePath = $fileNameToStore;
            $product->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "product has beed created !", "data" => $product], 200);

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
    public function edit(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $fileNameToStore = null;
        DB::beginTransaction();
        try {

            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'price' => 'numeric',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048|dimensions:min_width=100,max_width=1500',
                'description' => 'string',
            ]);
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            if ($request->hasFile('image')) {
                if (File::exists('storage/' . $product->imagePath)) {
                    File::delete('storage/' . $product->imagePath);
                }
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = date('Y-m-d') . '-' . $this->generateRandomString(5) . '.' . time() . '.' . $extension;
                $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
                $fileNameToStore = 'image/' . $fileNameToStore;
                $product->imagePath = $fileNameToStore;
            }
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->imagePath = $fileNameToStore;
            $product->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "product has beed updated !", "data" => $product], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
          try {
            if (File::exists('storage/' . $product->imagePath)) {
                File::delete('storage/' . $product->imagePath);
            }

            $product->delete();
            return response()->json(['message' => "Product has been delete !"], 200);

        } catch (\Throwable $th) {
            return response()->json('Terjadi Kesalahan !', 500);
        }
    }
}
