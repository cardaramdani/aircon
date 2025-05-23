

@extends('layouts.master')
@section('tambahan_link')
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
    <link href="{{URL::to('assets1/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/assets/css/Sidebar_submenu-dashboard/style.css')}}">
    <link href="{{URL::to('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('assets1/css/style.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header mt-5">
                <div class="panel">
                    <div class="row" style="margin-bottom: 1rem;">
                        <div class="col-md-8">
                            <h1 style="font-weight: bold; margin-left: 15px;">Work Orders</h1>
                        </div>
                        <div class="btn-group col-md-4" role="group" aria-label="Basic example">
                            <button type="button" class="btn-create-data btn btn-secondary " id="tombol-tambah"><i class="fas fa-folder-plus"></i>Add Work Order</button>
                        </div>
                    </div>
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Start Date" readonly />
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="End Date" readonly />
                        </div>

                        <div class="btn-group col-md-4" role="group" aria-label="Basic example">
                            <button type="button" name="filter" id="filter" class="btn-filter btn btn-primary">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn-refresh btn btn-primary" ><img src="/assets/icons/Icon_Reset.png" alt=""> reset</button>
                            <button type="button" name="export" id="export" class="btn-export btn btn-primary" ><i class="fas fa-file-excel"></i>Export</button>
                        </div>
                    </div>

                        <!-- AKHIR DATE RANGE PICKER -->
                        <br>
                    </div>
                    <div class="panel">
                        <div class="card-body">
                        <!-- MULAI TABLE -->
                        <table class="table table-striped table-bordered table-sm" id="table_workorder">
                            <thead>
                                <tr>
                                    <th class="text-left">Teknisi</th>
                                    <th class="text-left">Nama Customers</th>
                                    <th class="text-left">Phone</th>
                                    <th class="text-left">Alamat</th>
                                    <th class="text-left">Service Items</th>
                                    <th class="text-left">Schedule</th>
                                    <th class="text-left">Catatan</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- AKHIR TABLE -->
                        <!-- MULAI MODAL FORM TAMBAH/EDIT-->
                        <div class="modal fade " id="tambah-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content " style="background-color: #1f1f1ef0; color:#0066ff;">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="modal-judul-staff"></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-tambah-edit" name="form-tambah" class="form-horizontal">
                                            <input type="hidden" name="id" id="id">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="customername">Nama Customer</label>
                                                        <input id="customername" type="text" class="form-control @error('customername') is-invalid @enderror" name="customername" placeholder="Nama Customer" value="{{ old('customername') }}" required autocomplete="customername">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email Customer</label>
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email" value="{{ old('email') }}" required autocomplete="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">No Telpon Customer</label>
                                                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Alamat Customer</label>
                                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="address" value="{{ old('address') }}" required autocomplete="address">
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="jenisac">Pilih Service Item</label>
                                                        <select id="jenisac" name="jenisac" class="custom-select" >
                                                        <option value="" >Pilih Jenis Ac</option>
                                                        <option value="Splite Wall" >Splite Wall</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="workorder">Pilih Service Item</label>

                                                        <select id="workorder" name="workorder" class="custom-select" >
                                                        <option value="" >Pilih Kapasitas Ac</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi">Pilih Service Item</label>

                                                        <select id="deskripsi" name="deskripsi" class="custom-select" >
                                                        <option value="" >Jenis Maintenance</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="qty">Jumlah Unit (Qty)</label>
                                                    <input id="qty" type="number" class="form-control" name="qty" value="1" min="1" required>
                                                  </div>

                                                  <div class="form-group" id="item">
                                                    <select class="custom-select" name="items[]" id="items">
                                                        <!-- Pilihan untuk select #part -->
                                                    </select>
                                                </div>

                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0">
                                                        <button class="btn btn-primary btn-block" type="submit">Save</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL -->

                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection

@section('script')
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
    integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script src="{{URL::to('assets1/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{URL::to('assets1/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- JAVASCRIPT -->
    <script>
        //CSRF TOKEN PADA HEADER
        //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
        $(document).ready(function () {
            $(".sidebar-btn").click(function(){
                $(".wrapper").toggleClass("ini-collapse");
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //jalankan function load_data diawal agar data ter-load
            load_data();
            //Iniliasi datepicker pada class input
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
            $('#filter').click(function () {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    $('#table_workorder').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

        $('#refresh').click(function () {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#table_workorder').DataTable().destroy();
                load_data();
            });

            $('#export').click(function (e) {
                e.preventDefault();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    $.ajax({
                        data: {from_date:from_date, to_date:to_date}, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "", //url simpan data
                        type: "GET", //karena simpan kita pakai method POST
                        dataType: 'json',

                        complete:function(data){
                            location.href="/workorder/export?"+"from_date="+from_date+"&"+"to_date="+to_date;
                            }

                    });

                } else {
                    alert('Both Date is required');
                }
            });

            //LOAD DATATABLE
            //script untuk memanggil data json dari server dan menampilkannya berupa datatable
            //load data menggunakan parameter tanggal dari dan tanggal hingga
            function load_data(from_date = '', to_date = '') {
                $('#table_workorder').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true, // mencegah duplikasi table
                    ajax: {
                        url: "{{ route('workorder.index') }}",
                        type: 'GET',
                        data: { from_date: from_date, to_date: to_date },
                    },
                    columns: [
                        { data: 'user_id', name: 'user_id' },
                        { data: 'name', name: 'name' },
                        { data: 'phone', name: 'phone' },
                        { data: 'address', name: 'address' },
                        { data: 'service_items', name: 'service_items', orderable: false, searchable: false },
                        { data: 'scheduled_at', name: 'scheduled_at', orderable: false, searchable: false },
                        { data: 'complaint', name: 'complaint', orderable: false, searchable: false },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                // Tampilkan status dengan badge (opsional mempercantik)
                                let badgeClass = 'secondary';
                                switch(data) {
                                    case 'pending': badgeClass = 'warning'; break;
                                    case 'scheduled': badgeClass = 'info'; break;
                                    case 'inprogress': badgeClass = 'primary'; break;
                                    case 'done': badgeClass = 'success'; break;
                                    case 'canceled': badgeClass = 'danger'; break;
                                }
                                return `<span class="badge badge-${badgeClass}">${data}</span>`;
                            }
                        },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [[3, 'desc']]
                });
            }
        });
        //TOMBOL TAMBAH DATA
        //jika tombol-tambah diklik maka
        $('#tombol-tambah').click(function () {
            // $('#button-simpan').val("create-post"); //valuenya menjadi create-post
            $('#id').val(''); //valuenya menjadi kosong
            $('#form-tambah').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul-staff').html("Add Work Orders"); //valuenya tambah pegawai baru
            $('#tambah-modal').modal('show'); //modal tampil
            $('#id').val('');
            $('#customername').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#address').val('');
            $('#jenisac').val('');
            $('#workorder').val('');
            $('#deskripsi').val('');
            $('#qtt').val('');
            // $('#qtt').empty();


        });

        $('#jenisac').on('change',function(){
                var jenisac = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/pricelist/kapasitas',
                    data : {jenisac:jenisac},
                    success:function(data){
                        console.log(data);
                        var isi_data =JSON.parse(data);
                        $('#workorder').empty();
                        $('#workorder').append('<option value="" disabled selected>Pilih Kapasitas AC</option>');
                        isi_data.forEach(data => {
                        $('#workorder').append(`<option value="${data['kapasitas']}">${data['kapasitas']}</option>`);
                        });

                    },
                    error:function(data){
                    }
                });
            });

        $('#workorder').on('change', function() {
            var jenisac = $('#jenisac').val();
            var kapasitas = $(this).val();
            $('#deskripsi').empty().append('<option selected disabled>Loading...</option>');

            $.ajax({
                type: 'GET',
                url: 'pricelist/item',
                data: { jenisac:jenisac, kapasitas: kapasitas },
                success: function(data_deskripsi) {
                    var isi_data =JSON.parse(data_deskripsi);
                        $('#deskripsi').empty();
                        $('#deskripsi').append('<option value="" disabled selected>Pilih Type Service</option>');
                        isi_data.forEach(data_item_service => {
                        $('#deskripsi').append(`<option value="${data_item_service['id']}">${data_item_service['deskripsi']}</option>`);
                        });
                }
            });
        });

        // $('#deskripsi').on('change', function() {
        //     var jenisac = $('#jenisac').val();
        //     var kapasitas = $(this).val();
        //     $('#items').append(`
        //     <option value="">misalkan</option>
        //     `);


        // });

        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-tambah-edit')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('workorder.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON

                        success: function (data) {
                            //jika berhasil
                            console.log(data);
                            $('#form-tambah-edit').trigger("reset"); //form reset
                            $('#tambah-modal').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#table_workorder').dataTable(); //inialisasi datatable
                                oTable.fnDraw(false); //reset datatable
                            if(data.success){
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Updated success',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                                });
                            }
                            if(data.errors)
                            {
                                iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: data.errors,
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                            });
                            }

                        },
                        error: function (data) { //jika error tampilkan error pada console
                        }
                    });

                }
            })
        }
        //ketika class edit-post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('workorder/edit/' + data_id,
            function (data) {
                console.log(data);
                $('#modal-judul-staff').html("Update Price List");
                $('#btn-name').html("update"); //valuenya tambah
                $('#tombol-simpan').val("edit-post");
                // $('#edit-modal').modal('show');
                $('#tambah-modal').modal('show'); //modal tampil

                $('#id').val('');
                $('#customername').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#address').val('');
                $('#jenisac').empty();
                $('#workorder').empty();
                $('#deskripsi').empty();
                $('#qtt').val('');

                $('#id').val(data.workorder.id);
                $('#customername').val(data.workorder.name);
                $('#email').val(data.workorder.email);
                $('#phone').val(data.workorder.phone);
                $('#address').val(data.workorder.address);
                $('#jenisac').append(`
                            <option value="" >${data.items[0]['tipe']}</option>

                    `);
                $('#workorder').append(`
                            <option value="" >${data.items[0]['kapasitas']}</option>

                    `);
                    $('#deskripsi').append(`
                            <option value="" >${data.items[0]['deskripsi']}</option>

                    `);
                    $('#qty').append(`
                            <option value="" >${data.workorder.service_items[0]['qtt']}</option>

                    `);
                // $('#qty').val(data.workorder.service_items[0]['qtt']);
                $('#harga').val(data.workorder.harga);
        })
    });


        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
            $('#tombol-hapus').text('Delete'); //set text untuk tombol hapus

        });
        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({
                url: "workorder/delete/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Deleting'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses

                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_workorder').dataTable();
                        oTable.fnDraw(false); //reset datatable

                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'topRight'
                    });
                }
            })
        });

    </script>

    <!-- JAVASCRIPT -->

@endsection

