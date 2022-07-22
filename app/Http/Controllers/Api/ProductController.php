<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all (Request $request){

        $id = $request->input('id');

        if($id){
            $product = Product::find($id);
            if($product){
                return ResponseFormatter::success($product,'Success');
            }else return ResponseFormatter::error(null, 'Data Not Found',484);

        }

        $product = Product::all();
        return ResponseFormatter::success($product, 'Success');

    }
}
