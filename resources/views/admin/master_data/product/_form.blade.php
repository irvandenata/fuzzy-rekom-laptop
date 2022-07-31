@extends('utils.modal')
@section('input-form')
	<div class="form-group">
		<div class="form-line">
			<label for="name">Tipe</label>
			<input type="text" name="tipe" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Tahun</label>
			<input type="number" name="tahun" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Processor</label>
			<input type="text" name="processor" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Speed Processor</label>
			<input type="number" step="0.01" name="speed_processor" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">RAM</label>
			<input type="number" name="ram" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Speed RAM</label>
			<input type="number" name="speed_ram" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Storage</label>
			<input type="number" name="storage" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Speed Write</label>
			<input type="number" name="speed_write" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Speed Read</label>
			<input type="number" name="speed_read" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Harga</label>
			<input type="number" name="harga" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Gambar Produk</label>
			<input type="file" name="image" class="form-control">
		</div>
	</div>
@endsection
