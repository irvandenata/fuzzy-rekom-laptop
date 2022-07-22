<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use \Midtrans\Config;
use \Midtrans\Snap;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');

        if ($id) {
            $transaction = Transaction::with(['user', 'product'])->find($id);
            if ($transaction) {
                return ResponseFormatter::success($transaction, 'Success');
            } else {
                return ResponseFormatter::error(null, 'Data Not Found', 484);
            }

        }

        $transaction = transaction::with(['user', 'product'])->where('user_id', auth()->user()->id)->get();
        return ResponseFormatter::success($transaction, 'Success');

    }
    public function checkout(Request $request)
    {

        try {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'total' => 'required',
            'status' => 'required',
        ]);

        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'total' => $request->total,
            'status' => $request->status,
            'payment_url' => '',
        ]);

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$clientKey = config('services.midtrans.clientKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $transaction = Transaction::find($transaction->id);
        $midtrains = [
            "transaction_details" => [
                "order_id" => $transaction->id,
                "gross_amount" => $transaction->total,
            ],
            "credit_card" => [
                "secure" => true,
            ],
            "customer_details" => [
                "first_name" => auth()->user()->name,
                "email" => auth()->user()->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => [],
        ];


            $paymentUrl = Snap::createTransaction($midtrains)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            return ResponseFormatter::success($transaction, 'Transaksi Berhasil !');

        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Transaksi Gagal !');

        }
    }
}
