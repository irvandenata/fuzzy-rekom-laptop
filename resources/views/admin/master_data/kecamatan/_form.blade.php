@extends('utils.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
    <label for="type">Pilih Kota</label><br>
    <select class="form-control select2 w-full" style="width: 100% !important;"  name="kota_id" id="kota" required>
        <option disabled selected value>---- Pilih Salah Satu ----</option>
        @foreach($kota as $item)
            <option value="{!! $item->id !!}">{!! $item->nama_kota !!}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group">
        <div class="form-line">
            <label for="name">Nama Kecamatan</label>
            <input type="text" name="nama_kecamatan" class="form-control">
        </div>
    </div>
</div>
@endsection
