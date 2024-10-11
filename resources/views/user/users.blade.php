

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
                            <h1 style="font-weight: bold; margin-left: 15px;">List Staff</h1>
                        </div>
                        @role('Super-Admin|Admin|')
                        <div class="btn-group col-md-4" role="group" aria-label="Basic example">
                            <button type="button" class="btn-create-data btn btn-secondary " id="tombol-tambah"><i class="fas fa-folder-plus"></i>Add Staff</button>
                        </div>
                        @endrole
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
                            @role('Super-Admin|Admin|')
                            <button type="button" name="export" id="export" class="btn-export btn btn-primary" ><i class="fas fa-file-excel"></i>Export</button>
                            @endrole
                        </div>
                    </div>

                        <!-- AKHIR DATE RANGE PICKER -->
                        <br>
                    </div>
                    <div class="panel">
                        <div class="card-body">
                        <!-- MULAI TABLE -->
                        <table class="table table-striped table-bordered table-sm" id="table_users">
                            <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Alamat</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-left">Phone No</th>
                                    <th class="text-left">Tanggal Join</th>
                                    <th class="text-left">Role</th>
                             @role('Super-Admin|Admin|')
                                    <th class="text-left">Action</th>
                                    @endrole
                                </tr>
                            </thead>
                        </table>
                        <!-- AKHIR TABLE -->
                        <!-- MULAI MODAL FORM TAMBAH/EDIT-->
                        <div class="modal fade " id="tambah-modal-staff" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content " style="background-color: #1f1f1ef0; color:#1ab394;">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="modal-judul-staff"></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-tambah" name="form-tambah" class="form-horizontal">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <select class="custom-select" name="site" id="site" required>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <select id="department" name="department" class="custom-select" >
                                                        <option value="0" disabled selected>Select Department</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Enter Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autocomplete="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="new-password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password" required autocomplete="new-password">
                                                    </div>
                                                    <div class="row form-row">


                                                            <div class="form-group col-md-4">
                                                                <label for="position">Position</label>
                                                                <select id="position" name="position" class="form-control" >
                                                                <option selected >Select Position</option>
                                                                <option value="staff" >Staff</option>
                                                                <option value="supervisor" >Supervisor</option>
                                                                <option value="hrd" >HRD</option>
                                                                </select>
                                                            </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="role">Role</label>
                                                            <select id="role" name="role" class="form-control" >
                                                            <option selected >Select Role</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                    <div class="form-group mb-0">
                                                        <button class="btn btn-primary btn-block" type="submit">Register</button>
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


                        <!-- MULAI MODAL/EDIT-->
                        <div class="modal fade bd-example-modal-xl" id="edit-modal-staff" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content " style="background-color: #1f1f1ef0; color:#1ab394; width:fit-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="modal-judul-edit"></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal" enctype="multipart/form-data"> --}}
                                        <form id="form-tambah-edit" name="form-tambah-edit"  class="d-inline offset-md-5" enctype="multipart/form-data">
                                            <input type="hidden"  name="avatar_edit" id="avatar_edit" >
                                            <input type="hidden"  name="id" id="id" >

                                            <div class="row form-row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Site</label>
                                                        <select class="custom-select" name="site" id="site_edit" required>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="name" id="name_edit" >
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" id="last_name_edit" > </div>
                                                </div>
                                                <div class="col-12 col-sm-6" >
                                                    <div class="form-label-group">
                                                    <label for="department">Department</label>
                                                        <select id="department_edit" name="department"  class="form-control">
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6" id="label_department">
                                                    <div class="form-label-group">

                                                    <label for="position">Position</label>
                                                        <select id="position" name="position" id="position_edit" class="form-control">
                                                        <option selected id="position_edit" value="position_edit"></option>
                                                        <option value="staff" >Staff</option>
                                                        <option value="supervisor" >Supervisor</option>
                                                        <option value="hrd" >HRD</option>
                                                        </select>
                                                        @error('position')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input type="email" class="form-control" name="email" id="email_edit" value=""> </div>
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input type="text" name="phone_number" id="phone_number_edit" value="" class="form-control"> </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_tanggal_lahir">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir_edit" value=""> </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Biological Mother</label>
                                                        <input type="text" name="nama_ibu_kandung" id="nama_ibu_kandung_edit" value="" class="form-control"> </div>
                                                </div>

                                                <div class="col-12 col-sm-4" id="label_nik">
                                                    <div class="form-group">
                                                        <label>NIK</label>
                                                        <input type="text" class="form-control" name="nik" id="nik_edit" value=""> </div>
                                                </div>
                                                <div class="col-12 col-sm-4" id="label_no_ktp">
                                                    <div class="form-group">
                                                        <label>KTP ID</label>
                                                        <input type="text" class="form-control" name="no_ktp" id="no_ktp_edit" value=""> </div>
                                                </div>
                                                <div class="col-12 col-sm-4" id="label_npwp">
                                                    <div class="form-group">
                                                        <label>NPWP</label>
                                                        <input type="text" class="form-control" name="npwp" id="npwp_edit" value=""> </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_bpjstk">
                                                    <div class="form-group">
                                                        <label>BPJS Ketenagakerjaan</label>
                                                        <input type="text" class="form-control" name="bpjstk" id="bpjstk_edit" value=""> </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_bpjskes">
                                                    <div class="form-group">
                                                        <label>BPJS Kesehatan</label>
                                                        <input type="text" class="form-control" name="bpjskes" id="bpjskes_edit" value=""> </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input type="text" class="form-control" name="negara" id="negara_edit" value=""> </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Religion</label>
                                                        <input type="text" class="form-control" name="agama" id="agama_edit" value=""> </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-label-group">
                                                        <label for="kelamin">Gender</label>
                                                        <select id="kelamin" name="kelamin" id="kelamin_edit" class="form-control">
                                                        <option selected id="kelamin_edit" ></option>
                                                        <option select>Laki-laki</option>
                                                        <option select>Perempuan</option>
                                                        </select>
                                                        @error('kelamin')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-12 col-sm-6" id="label_pendidikan">
                                                    <div class="form-group">
                                                        <label>Education</label>
                                                        <input type="text" class="form-control" name="pendidikan" id="pendidikan_edit" value="">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-label-group">
                                                        <label for="ukuran_seragam">Size of Uniform</label>
                                                        <select id="ukuran_seragam" name="ukuran_seragam" id="ukuran_seragam_edit" class="form-control">
                                                        <option selected id="ukuran_seragam_edit" ></option>
                                                        <option select>S</option>
                                                        <option select>M</option>
                                                        <option select>L</option>
                                                        <option select>XL</option>
                                                        <option select>XXL</option>
                                                        </select>
                                                        @error('ukuran_seragam')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-12 col-sm-6" id="label_pendidikan">
                                                    <div class="form-label-group">
                                                            <label for="ukuran_sepatu">Size of Shoe</label>
                                                            <select id="ukuran_sepatu" name="ukuran_sepatu" id="ukuran_sepatu_edit" class="form-control">
                                                            <option selected id="ukuran_sepatu_edit" ></option>
                                                            <option select>35</option>
                                                            <option select>36</option>
                                                            <option select>37</option>
                                                            <option select>38</option>
                                                            <option select>39</option>
                                                            <option select>40</option>
                                                            <option select>41</option>
                                                            <option select>42</option>
                                                            <option select>43</option>
                                                            </select>
                                                            @error('ukuran_sepatu')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6" id="label_join_date">
                                                    <div class="form-group">
                                                        <label>Join Date</label>
                                                        <input type="date" class="form-control" name="join_date" id="join_date_edit" value="">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_status">
                                                    <div class="form-label-group">
                                                        <label for="status">Status</label>
                                                        <select  name="status" id="status_edit" class="form-control">
                                                        <option selected id="status_edit" ></option>
                                                        <option select>Kawin</option>
                                                        <option select>Tidak Kawin</option>
                                                        </select>
                                                        @error('status')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_start_pkwt1">
                                                    <div class="form-group">
                                                        <label>Start Contract 1</label>
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="start_pkwt1" id="start_pkwt1_edit" value=""> </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_end_pkwt1">
                                                    <div class="form-group">
                                                        <label>End Contract 1</label>
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="end_pkwt1" id="end_pkwt1_edit" value=""> </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6" id="label_start_pkwt2">
                                                    <div class="form-group">
                                                        <label>Start Contract 2</label>
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="start_pkwt2" id="start_pkwt2_edit" value=""> </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_end_pkwt2">
                                                    <div class="form-group">
                                                        <label>End Contract 2</label>
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="end_pkwt2" id="end_pkwt2_edit" value=""> </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6" id="label_start_pkwt3">
                                                    <div class="form-group">
                                                        <label>Start Contract 3</label>
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="start_pkwt3" id="start_pkwt3_edit" value=""> </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6" id="label_end_pkwt3">
                                                    <div class="form-group">
                                                        <label>End Contract 3</label>
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="end_pkwt3" id="end_pkwt3_edit" value=""> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="role_edit">Role</label>
                                                    <select id="role_edit" name="role" class="form-control" >
                                                    <option selected >Select Role</option>
                                                    </select>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" name="addres" id="addres_edit" value="">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Mailing Address</label>
                                                        <input type="text" class="form-control" name="alamat_surat" id="alamat_surat_edit" value="">
                                                    </div>
                                                </div>


                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                                            value="create">Update
                                        </button>
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
            $('#filter').click(function () {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    $('#table_users').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

        $('#refresh').click(function () {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#table_users').DataTable().destroy();
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
                            location.href="/users/export?"+"from_date="+from_date+"&"+"to_date="+to_date;
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
                $('#table_users').DataTable({
                    processing: true,
                    serverSide: true, //aktifkan server-side
                    ajax: {
                        url: "{{ route('users.index') }}",
                        type: 'GET',
                        data:{from_date:from_date, to_date:to_date }
                        //jangan lupa kirim parameter tanggal
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'alamat',
                            name: 'alamat'
                        },

                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'telepon',
                            name: 'telepon'
                        },
                        {
                            data: 'tanggal_bergabung',
                            name: 'tanggal_bergabung'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        @role('Super-Admin|Admin|')
                        {
                            data: 'action',
                            name: 'action'
                        },
                        @endrole


                    ],
                    order: [
                        [3, 'decs']
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
            $('#modal-judul-staff').html("Add Staff"); //valuenya tambah pegawai baru
            $('#tambah-modal-staff').modal('show'); //modal tampil
            $.ajax({
                    type: 'GET',
                    url: '/role/all',
                    success:function(data){
                        var isi_data =JSON.parse(data);

                        $('#role').empty();
                        isi_data.forEach(data => {
                        $('#role').append(`<option value="${data['name']}">${data['name']}</option>`);
                        });

                    },
            });

            $.ajax({
                    type: 'GET',
                    url: '/get/site',
                    success:function(data){

                        var isi_data =JSON.parse(data);

                        $('#site').empty();
                        $('#site').append('<option value="0" disabled selected>Select Site</option>');
                        isi_data.forEach(data => {
                        $('#site').append(`<option value="${data['id']}">${data['site_name']}</option>`);
                        });

                    },
            });

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
                        url: "", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON

                        success: function (data) { //jika berhasil
                            $('#form-tambah').trigger("reset"); //form reset
                            $('#tambah-modal-staff').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#table_users').dataTable(); //inialisasi datatable
                                oTable.fnDraw(false); //reset datatable
                            if(data.success){
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: data.success,
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


        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-tambah-edit')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON

                        success: function (data) {
                            //jika berhasil
                            $('#form-tambah-edit').trigger("reset"); //form reset
                            $('#edit-modal-staff').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#table_users').dataTable(); //inialisasi datatable
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

            $.get('users/edit/' + data_id,
            function (data) {

                $('#modal-judul-edit').html("Update Staff");
                $('#btn-name').html("update"); //valuenya tambah
                $('#tombol-simpan').val("edit-post");
                // $('#edit-modal').modal('show');
                $('#edit-modal-staff').modal('show'); //modal tampil

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
                // $('#nik').show();
                // $('#position').show();
                // $('#department').show();
                $('#id').val(data.user.id);site_edit
                $.ajax({
                    type: 'GET',
                    url: '/get/site',
                    success:function(data_site){
                        if (data.user.site == null) {
                        var isi_data_site =JSON.parse(data_site);
                            $('#site_edit').empty();
                            $('#site_edit').append(`<option value="">Select Site</option>`);
                            isi_data_site.forEach(data => {
                                $('#site_edit').append(`<option value="${data['id']}">${data['site_name']}</option>`);
                                });
                        } else {
                            var isi_data_site =JSON.parse(data_site);
                            $('#site_edit').empty();
                            $('#site_edit').append(`<option value="${data.user.site}">${data.user.sitename['site_name']}</option>`);
                            isi_data_site.forEach(data => {
                                $('#site_edit').append(`<option value="${data['id']}">${data['site_name']}</option>`);
                                });
                        }

                    },
                });
                $('#name_edit').val(data.user.name);
                $('#last_name_edit').val(data.user.last_name);
                $('#position_edit').val(data.user.position);
                $('#position_edit').html(data.user.position);
                $('#department_edit').empty();
                $('#department_edit').append(`<option value="${data.user.department}">${data.user.department}</option>`);
                // $('#department_edit').html(data.user.department);
                $('#tanggal_lahir_edit').val(data.user.tanggal_lahir);
                $('#nama_ibu_kandung_edit').val(data.user.nama_ibu_kandung);
                $('#email_edit').val(data.user.email);
                $('#phone_number_edit').val(data.user.phone_number);
                $('#nik_edit').val(data.user.nik);
                $('#no_ktp_edit').val(data.user.no_ktp);
                $('#npwp_edit').val(data.user.npwp);
                $('#bpjstk_edit').val(data.user.bpjstk);
                $('#bpjskes_edit').val(data.user.bpjskes);
                $('#negara_edit').val(data.user.negara);
                $('#agama_edit').val(data.user.agama);
                $('#kelamin_edit').val(data.user.kelamin);
                $('#kelamin_edit').html(data.user.kelamin);
                $('#pendidikan_edit').val(data.user.pendidikan);
                $('#join_date_edit').val(data.user.join_date);
                $('#status_edit').val(data.user.status);

                $('#ukuran_seragam_edit').html(data.user.ukuran_seragam);
                $('#ukuran_sepatu_edit').html(data.user.ukuran_sepatu);
                $('#addres_edit').val(data.user.addres);
                $('#alamat_surat_edit').val(data.user.alamat_surat);
                $('#avatar_edit').val(data.user.avatar);
                $('#start_pkwt1_edit').val(data.user.start_pkwt1);
                $('#end_pkwt1_edit').val(data.user.end_pkwt1);
                $('#start_pkwt2_edit').val(data.user.start_pkwt2);
                $('#end_pkwt2_edit').val(data.user.end_pkwt2);
                $('#start_pkwt3_edit').val(data.user.start_pkwt3);
                $('#end_pkwt3_edit').val(data.user.end_pkwt3);

                $.ajax({
                    type: 'GET',
                    url: '/role/all',
                    success:function(data_role){
                        var isi_data_role =JSON.parse(data_role);

                        $('#role_edit').empty();
                        $('#role_edit').append(`<option value="${data.role[0]}">${data.role[0]}</option>`);
                        isi_data_role.forEach(data => {
                        $('#role_edit').append(`<option value="${data['name']}">${data['name']}</option>`);
                        });

                    },
            });

        })
    });

    $('#site').on('change',function(){
        var site_id = $(this).val();

        $('#department').empty();
        $('#department').append('<option value="0" disabled selected>Select Department</option>');
        $.ajax({
            type: 'GET',
            url: '/get/departmentbyid/'+site_id,
            success:function(data){

                var isi_data =JSON.parse(data);
                $('#department').empty();
                $('#department').append('<option value="0" disabled selected>Select Department</option>');
                isi_data.forEach(data => {
                $('#department').append(`<option value="${data['name']}">${data['name']}</option>`);
                });

                },
                error:function(data){

                }
            });

    });

    $('#site_edit').on('change',function(){
        var site_id = $(this).val();

        $('#department_edit').empty();
        $('#department_edit').append('<option value="0" disabled selected>Select Department</option>');
        $.ajax({
            type: 'GET',
            url: '/get/departmentbyid/'+site_id,
            success:function(data){

                var isi_data =JSON.parse(data);
                $('#department_edit').empty();
                $('#department_edit').append('<option value="0" disabled selected>Select Department</option>');
                isi_data.forEach(data => {
                $('#department_edit').append(`<option value="${data['name']}">${data['name']}</option>`);
                });

                },
                error:function(data){

                }
            });

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
                url: "users/delete/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Deleting'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses

                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_users').dataTable();
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

