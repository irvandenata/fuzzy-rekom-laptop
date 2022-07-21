@extends('utils.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
    <label for="type">Pilih Kecamatan</label><br>
    <select class="form-control select2 w-full" style="width: 100% !important;"  name="kecamatan_id" id="kecamatan" required>
        <option disabled selected value>---- Pilih Salah Satu ----</option>
        @foreach($kecamatan as $item)
            <option value="{!! $item->id !!}">{!! $item->nama_kecamatan !!} : Kab.{!! $item->kota->nama_kota !!}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group">
        <div class="form-line">
            <label for="name">Nama Kelurahan</label>
            <input type="text" name="nama_kelurahan" class="form-control">
        </div>
    </div>
</div>
@endsection
