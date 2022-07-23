<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Transaction::latest()->with(['user', 'product'])->latest()->get();

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
        $data['title'] = "Data Transaksi";
        $data['product'] = Product::get();
        $data['user'] = User::get();
        return view('admin.master_data.transaction.index', $data);
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

        DB::beginTransaction();
        try {
            $v = Validator::make($request->all(), [
                'user_id' => 'required',
                'product_id' => 'required',
            ]);
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }
            $transaction = new Transaction();
            $transaction->user_id = $request->user_id;
            $transaction->product_id = $request->product_id;
            $transaction->total = 0;
            $transaction->payment_url = $request->payment_url;
            $transaction->status = 'Pending';
            $transaction->save();
            $transaction->total = $transaction->product->price * $request->amount;
            $transaction->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "Data transaction Berhasil dibuat !", "data" => $transaction], 200);

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
    public function edit(Transaction $transaction)
    {
        $transaction->amount = $transaction->total / $transaction->product->price;
        return $transaction;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            $v = Validator::make($request->all(), [
                'user_id' => 'required',
                'product_id' => 'required',
            ]);
            if ($v->fails()) {
                throw new CustomException("error", 500, null, $v->errors()->all());
            }

            $transaction->user_id = $request->user_id;
            $transaction->product_id = $request->product_id;
            $transaction->total = 0;
            $transaction->payment_url = $request->payment_url;
            $transaction->save();
            $transaction->total = $transaction->product->price * $request->amount;
            $transaction->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        }
        return response()->json(['message' => "Data transaction Berhasil diperbaharui !", "data" => $transaction], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {

        try {
            $transaction->delete();
            return response()->json(['message' => "Transaksi telah dihapus !"], 200);

        } catch (\Throwable $th) {
            return response()->json('Terjadi Kesalahan !', 500);
        }

    }
}
