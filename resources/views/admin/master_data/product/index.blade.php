@extends('layouts.template')

@section('title', $title)

@push('css')
	<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

	<link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">
@endpush

@push('style')
@endpush

@section('content')
	<div class="row container-fluid">
		<div class="col-12">
			<div class="card p-4">
				<div class="table-responsive">

					<table id="datatable" class="table table-bordered  m-t-30">
						<thead>
							<tr>
								<th width="10%">No</th>
								<th>Tipe</th>
								<th>Tahun</th>
								<th>Processor</th>
								<th>Speed Processor</th>
								<th>RAM</th>
								<th>Speed RAM</th>
								<th>Storage</th>
								<th>Speed Write</th>
								<th>Speed Read</th>
								<th>Harga</th>
								<th>Gambar</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

		</div>
		@include('admin.master_data.product._form')
	</div>
@endsection

@push('js')
	<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>
@endpush

@push('script')
	@include('utils.js')
	<script>
	 let dataTable = $('#datatable').DataTable({
	  dom: 'lBfrtip',
	  buttons: [{
	   className: 'btn btn-success btn-sm mr-2',
	   text: 'Create',
	   action: function(e, dt, node, config) {
	    createItem();
	   }
	  }, {
	   className: 'btn btn-warning btn-sm mr-2',
	   text: 'Reload',
	   action: function(e, dt, node, config) {
	    reloadDatatable();
	    Toast.fire({
	     icon: 'success',
	     title: 'Reload'
	    })
	   }
	  }],
	  responsive: true,
	  processing: true,
	  serverSide: true,
	  searching: true,
	  pageLength: 5,
	  lengthMenu: [
	   [5, 10, 15, -1],
	   [5, 10, 15, "All"]
	  ],
	  ajax: {
	   url: child_url,
	   type: 'GET',
	  },
	  columns: [{
	    data: 'DT_RowIndex',
	    orderable: false
	   },
	   {
	    data: 'tipe',
	    orderable: true
	   },
	   {
	    data: 'tahun',
	    orderable: true
	   },
	   {
	    data: 'processor',
	    orderable: true
	   },
	   {
	    data: 'speed_processor',
	    orderable: true
	   },
	   {
	    data: 'ram',
	    orderable: true
	   },
	   {
	    data: 'speed_ram',
	    orderable: true
	   },
	   {
	    data: 'storage',
	    orderable: true
	   },
	   {
	    data: 'speed_write',
	    orderable: true
	   },
	   {
	    data: 'speed_read',
	    orderable: true
	   },
	   {
	    data: 'harga',
	    orderable: true
	   },
	   {
	    data: 'image',
	    orderable: true
	   },

	   {
	    data: 'action',
	    name: '#',
	    orderable: false
	   },
	  ]
	 });
	</script>

	<script>
	 function createItem() {
	  setForm('create', 'POST', ('Create {{ $title }}'), true)

	 }

	 function editItem(id) {
	  setForm('update', 'PUT', 'Edit {{ $title }}', true)
	  editData(id)


	 }

	 function deleteItem(id) {
	  deleteConfirm(id)

	 }
	</script>

	<script>
	 /** set data untuk edit**/
	 function setData(result) {
	  $('input[name=id]').val(result.id);
	  $('input[name=tipe]').val(result.tipe);
	  $('input[name=tahun]').val(result.tahun);
	  $('input[name=processor]').val(result.processor);
	  $('input[name=speed_processor]').val(result.speed_processor);
	  $('input[name=ram]').val(result.ram);
	  $('input[name=speed_ram]').val(result.speed_ram);
	  $('input[name=storage]').val(result.storage);
	  $('input[name=speed_write]').val(result.speed_write);
	  $('input[name=speed_read]').val(result.speed_read);
	  $('input[name=harga]').val(result.harga);
	 }


	 /** reload dataTable Setelah mengubah data**/
	 function reloadDatatable() {
	  dataTable.ajax.reload();
	 }
	</script>
@endpush
