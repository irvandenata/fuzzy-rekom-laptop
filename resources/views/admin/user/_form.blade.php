@extends('utils.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
        <label for="name">Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
</div>
<div class="form-group">
   <label for="type">Pilih Role</label>
   <select class="form-control show-tick" name="role_id" id="role" required >
      <option disabled selected value>---- Pilih Salah Satu ----</option>
@foreach($roles as $item)
      <option value="{!! $item->id !!}">{!! $item->name !!}</option>
@endforeach
   </select>
</div>

<div class="form-group">
    <div class="form-line">
        <label for="config_value">E-Mail</label>
        <input type="text" name="email" class="form-control" required>
    </div>
</div>

<div class="form-group">
    <div class="form-line">
        <label for="additional">Password</label>
        <input name="password" type="password" class="form-control addit" required>
    </div>
</div>


{{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar Produk</label>
        <input type="text" name="theme" class="form-control">
    </div>
</div> --}}

{{-- <div class="form-group">
   <label for="type">Pilih Salah Satu</label>
   <select class="form-control show-tick" name="type_id" id="typeID" required>
      <option disabled selected value>---- Pilih Salah Satu ----</option>
@foreach($type as $item)
      <option value="{!! $item->id !!}">{!! $item->name !!}</option>
@endforeach
   </select>
</div> --}}

@endsection
