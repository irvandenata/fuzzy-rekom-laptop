@extends('utils.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
        <label for="name">Nama Produk</label>
        <input type="text" name="name" class="form-control" >
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="name">Harga</label>
        <input type="number" name="price" class="form-control" >
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="name">Deskripsi</label>
        <textarea  name="description" class="form-control desc" ></textarea>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="name">Gambar Produk</label>
        <input type="file" name="image" class="form-control" >
    </div>
</div>
@endsection
