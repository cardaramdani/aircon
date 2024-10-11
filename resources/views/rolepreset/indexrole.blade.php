

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
                            <h1 style="font-weight: bold; margin-left: 15px;">Role</h1>
                        </div>
                        <div class="btn-group col-md-4" role="group" aria-label="Basic example">
                            <button type="button" class="btn-create-data btn btn-secondary " id="tombol-tambah"><i class="fas fa-folder-plus"></i>Add Role</button>
                        </div>
                    </div>


                        <!-- AKHIR DATE RANGE PICKER -->
                        <br>
                    </div>
                    <div class="panel">
                        <div class="card-body">
                        <!-- MULAI TABLE -->
                        <table class="table table-striped table-bordered table-sm" id="table_role">
                            <thead>
                                <tr>
                                    <th class="text-left">Role Name</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>
                        </table>
                        <!-- AKHIR TABLE -->
                        <!-- MULAI MODAL FORM TAMBAH/EDIT-->
                        <div class="modal fade " id="tambah-modal-role" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content " style="background-color: #1f1f1ef0; color:#1ab394;">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="modal-judul-role"></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-tambah" name="form-tambah" class="form-horizontal">
                                        <input type="hidden" name="id" id="id">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input name="role" id="role" type="text" class="form-control @error('role') is-invalid @enderror" role="role"  placeholder="Enter role" value="{{ old('role') }}" required autocomplete="role" autofocus>
                                                    </div>

                                                    </div>
                                                </div>
                                                    <div class="form-group mb-0">
                                                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
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
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script> --}}
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


            //LOAD DATATABLE
            //script untuk memanggil data json dari server dan menampilkannya berupa datatable
            //load data menggunakan parameter tanggal dari dan tanggal hingga
            function load_data(from_date = '', to_date = '') {
                $('#table_role').DataTable({
                    processing: true,
                    serverSide: true, //aktifkan server-side
                    ajax: {
                        url: "{{ route('rolepreset.index') }}",
                        type: 'GET',
                        data:{from_date:from_date, to_date:to_date }
                        //jangan lupa kirim parameter tanggal
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'action',
                            name: 'action'
                        },

                    ],
                    order: [
                        [0, 'decs']
                    ],
                });
            }
        });
        //TOMBOL TAMBAH DATA
        //jika tombol-tambah diklik maka
        $('#tombol-tambah').click(function () {
            // $('#button-simpan').val("create-post"); //valuenya menjadi create-post
            $('#id').val(''); //valuenya menjadi kosong
            $('#form-tambah').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul-role').html("Add Role"); //valuenya tambah pegawai baru
            $('#tambah-modal-role').modal('show'); //modal tampil
        });


        //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
        if ($("#form-tambah").length > 0) {
            $("#form-tambah").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-tambah')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('rolepreset.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON

                        success: function (data) { //jika berhasil
                            console.log(data);
                            $('#form-tambah').trigger("reset"); //form reset
                            $('#tambah-modal-role').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#table_role').dataTable(); //inialisasi datatable
                                oTable.fnDraw(false); //reset datatable
                            if(data.success){
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: "Role berhasil ditambahkan",
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
            $.get('rolepreset/edit/' + data_id,
            function (data) {
                $('#modal-judul-edit').html("Update Role");
                $('#btn-name').html("update"); //valuenya tambah
                $('#tombol-simpan').val("edit-post");
                // $('#edit-modal').modal('show');
                $('#tambah-modal-role').modal('show'); //modal tampil

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
                $('#id').val(data.id);
                $('#role').val(data.name);

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
                url: "rolepreset/delete/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Deleting'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses

                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_role').dataTable();
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

