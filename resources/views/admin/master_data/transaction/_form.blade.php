@extends('utils.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
        <label for="type">Pilih Produk</label><br>
        <select class="form-control select2-product w-full" style="width: 100% !important;" name="product_id" id="product" required>
            <option disabled selected value>---- Pilih Salah Satu ----</option>
            @foreach($product as $item)
                <option value="{!! $item->id !!}">{!! $item->name !!} : Rp.{!! $item->price !!}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
      <div class="form-line">
        <label for="type">Pilih Pembeli</label><br>
        <select class="form-control select2 w-full" style="width: 100% !important;" name="user_id" id="user" required>
            <option disabled selected value>---- Pilih Salah Satu ----</option>
            @foreach($user as $item)
                <option value="{!! $item->id !!}">{!! $item->name !!} - {!! $item->email !!} </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="name">Jumlah Barang</label>
        <input type="number" name="amount" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="name">Link Pembayaran</label>
        <input type="text" name="payment_url" class="form-control" required>
    </div>
</div>
@endsection
