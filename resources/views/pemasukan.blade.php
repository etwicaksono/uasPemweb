@extends('template/main')

@section('content')
<div class="row">
    <div class="col-lg-3 mb-4">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newTransModal" id="tambahPemasukan">Tambah
            Pemasukan</a>
    </div>
</div>
<!-- <div class="tabel-pemasukan" style="max-width: 1200p"> -->
<div class="table-responsive tabel-pemasukan">
    <table class="table table-hover col-lg-12 table-bordered table-striped dataTables" id="table-data">
            <thead>
                <tr>
                <th scope="col" class="text-center" style="width:5%">#</th>
                <th scope="col" class="text-center" style="width:10%">Tanggal</th>
                <th scope="col" class="text-center" style="width:10%">Aset</th>
                <th scope="col" class="text-center" style="width:10%">Akun</th>
                <th scope="col" class="text-center" style="width:10%">Jumlah</th>
                <th scope="col" class="text-center" style="width:10%">Keterangan</th>
                <th scope="col" class="text-center" style="width:10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

</div>

<!-- modal tambah -->
<div class="modal fade" id="newTransModal" tabindex="-1" role="dialog" aria-labelledby="newTransModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTransModalLabel">Tambah Pemasukan Baru</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="{{url('/insert_pemasukan')}}" method="post" id="form">
                {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tanggal" class="col-3 col-form-label">Tanggal</label>
                        <div class="col-9">
                        <input type="text" class="form-control datepicker-exec" id="tanggal" name="tanggal" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="terimaDari" class="col-3 col-form-label">Diterima dari</label>
                        <div class="col-9">
                            <select type="text" class="form-control" id="terimaDari" name="terimaDari" required>
                                <option value selected disabled>-- Pilih --</option>
                                @foreach ($i_accounts as $a)
                                <option value="{{$a->id}}">
                                    {{$a->kode}} - {{$a->account}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="simpanKe" class="col-3 col-form-label">Simpan ke</label>
                        <div class="col-9">
                            <select type="text" class="form-control" id="simpanKe" name="simpanKe" required>
                                <option value selected disabled>-- Pilih --</option>
                                @foreach ($a_accounts as $a)
                                <option value="{{$a->id}}">
                                    {{$a->kode}} - {{$a->asset}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-3 col-form-label">Jumlah</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="jumlah" name="jumlah" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn_save">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal delete --}}
<div class="modal" tabindex="-1" role="dialog" id="modal_delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="{{url('income/delete')}}" method="post" id="removeDataForm">
                @csrf
                <div class="modal-body">
                    <p>Apakah anda yakin</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn_delete">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#newTransModalLabel').html('Edit Data')
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        let table;
        table = $('#table-data').DataTable({
            responsive: true,
            serverSide: true,
			ajax: {
                url: "{{URL::to('pemasukan/json')}}",
            },
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                    { data: 'date', name: 'date'},
                    { data: 'assets', name: 'assets' },
                    { data: 'i_account', name: 'i_accounts' },
                    { data: 'total', name: 'total' },
                    { data: 'info', name: 'info' },
                    { 
                        data: 'id', name: 'id',
                        "render": function(data, type, row, meta) {
                            return "<button type='button' class='btn btn-info btn-icon btn-sm' onclick='edit(" + data + ")'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-icon btn-sm' onclick='deleteData(" + data + ")'><i class='fa fa-trash'></i></button>&nbsp;&nbsp;&nbsp;";
                    } 
                    }
            ],
        order: [[0, 'desc']]
        });

        function edit(id){
            console.log(id);
            $('#newTransModal').modal('show');
            $('#newTransModalLabel').html('Edit Data');
            $('#btn_save').html('Ubah');
            $.ajax({
                // type: 'post',
                url: "{{URL::to('pemasukan')}}/"+ id,
                method: "post",
                dataType: "json",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#tanggal').val(data.date);
                    $('#terimaDari').val(data.id_i_account);
                    $('#simpanKe').val(data.id_a_asset);
                    $('#jumlah').val(data.total);
                    $('#keterangan').val(data.info);
                } 
            });
        }

        let form = $('#form');
        $('#form').submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: $('#form').attr('action'), 
                // method: $('#form').attr('method'),
                method: 'get',
				data: form.serialize(),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
                dataType: 'json',
				success: function(response) {
                    console.log(response);
                    table.ajax.reload(null,false);
                    $('#newTransModal').modal('hide');
                    resetForm();
                    if(response.msg == 'Berhasil') {
			    	    Swal.fire(response.msg, response.info, response.icon);
                    } else if(response.msg == 'Gagal') {
					    Swal.fire(response.msg, response.info, response.icon)
                    }
						// resetForm();
				}
			});
		});

        function deleteData(id){
            console.log(id);
            $('#modal_delete').modal('show');
            $('#btn_delete').html('Hapus');
            $('#removeDataForm').submit(function(e){
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action')+"/"+ id,
                    // dataType: "json",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        table.ajax.reload(null,false);
                        $('#modal_delete').modal('hide');
                        
                        if(response.status == 1) {
                            Swal.fire(response.msg, response.info, response.icon);
                        } else {
                            Swal.fire(response.msg, response.info, response.icon);
                        }
                        
                    } 
                });
            })
        }

        function resetForm(){
            $('#id').val('');
            $('#tanggal').val('');
            $('#terimaDari').val('');
            $('#simpanKe').val('');
            $('#jumlah').val('');
            $('#keterangan').val('');
            // $('#form').trigger('reset');
        }
		
    </script>
@endsection