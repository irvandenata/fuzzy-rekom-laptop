@extends('utils.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
        <label for="name">Nama Pasien (<span class="text-danger">*</span>)</label>
        <input type="text" name="nama_pasien" class="form-control">
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="name">Alamat  (<span class="text-danger">*</span>)</label>
        <textarea name="alamat" class="form-control alamat"> </textarea>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="name">RT</label>
                <input type="number" name="rt" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="name">RW</label>
                <input type="number" name="rw" class="form-control">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="type">Pilih Kecamatan  (<span class="text-danger">*</span>)</label><br>
                <select class="form-control select2 w-full" style="width: 100% !important;" name="kelurahan_id" id="kelurahan" required>
                    <option disabled selected value>---- Pilih Salah Satu ----</option>
                    @foreach($kelurahan as $item)
                        <option value="{!! $item->id !!}">{!! $item->nama_kelurahan !!} - Kec.{!! $item->kecamatan->nama_kecamatan !!} - Kab/Kota.{!! $item->kecamatan->kota->nama_kota !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="type">Pilih Jenis Kelamin  (<span class="text-danger">*</span>)</label><br>
                <select class="form-control w-full" style="width: 100% !important;" name="jenis_kelamin" id="jenkel" required>
                    <option disabled selected value>---- Pilih Salah Satu ----</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="name">Nomor Telepon  (<span class="text-danger">*</span> 628489....)</label>
                <input type="number" name="no_telepon" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="name">Tanggal Lahir  (<span class="text-danger">*</span>)</label>

                <input type="text" name="tanggal_lahir" class="form-control" id="datepicker" required placeholder="pilih tanngal lahir">
            </div>
        </div>
    </div>
</div>
@endsection
