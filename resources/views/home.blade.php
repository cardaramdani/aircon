@extends('layouts.master')
@section('tambahan_link')
<!-- firebase integration started -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app-check.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-functions.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-performance.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-remote-config.js"></script>

    <!-- firebase integration started -->

    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script>

    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>

    <!-- firebase integration end -->

    <!-- Comment out (or don't include) services that you don't want to use -->
    <!-- <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-storage.js"></script> -->

<!-- firebase integration end -->

@endsection
@section('menu')
{{-- @extends('views2.sidebar.dashboard') --}}
@endsection
@section('content')
<button style="border-radius: 60%; font-size:6px; margin-left:20px;  width:50px;" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger fixed-bottom tombol-subscribe"><i class="far fa-bell" style="font-size: 20px;"></i> <br>Subscribe</button>

@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
      </div>
    @endif
    {{-- message --}}
    {{-- {!! Toastr::message() !!} --}}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 mt-5">
                        <h3 class="page-title mt-3">Hii, {{ Auth::user()->name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item active" id="kontrak"></li>
                        </ul>
                    </div>
                </div>
            </div>
            @role('Super-Admin|Admin')
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body btn-light" onclick="event.preventDefault();document.getElementById('workorder').submit();">
                            <form id="workorder" action="/workorder" method="get" style="display: none;">
                                @csrf
                            </form>
                            <div class="dash-widget-header ">
                                <div>
                                    <h3 class="card_widget_header" id="count_leave" style="color: #0066ff"></h3>
                                    <h6 class="text-muted">Work Order</h6> </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"><span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather ">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                        </path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="12" y1="18" x2="12" y2="12"></line>
                                        <line x1="9" y1="15" x2="15" y2="15"></line>
                                        </svg></span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body btn-light" onclick="event.preventDefault();document.getElementById('all-site-project').submit();">
                            <form id="all-site-project" action="/siteproject" method="get" style="display: none;">
                            </form>
                            <div class="dash-widget-header ">
                                <div>
                                    <h3 class="card_widget_header" id="count_site_project"></h3>
                                    <h6 class="text-muted">Total of Site Project</h6> </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather ">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                        </path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="12" y1="18" x2="12" y2="12"></line>
                                        <line x1="9" y1="15" x2="15" y2="15"></line>
                                        </svg></span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <div>
                                    <h3 class="card_widget_header">180</h3>
                                    <h6 class="text-muted">Form Request Tukar shift</h6> </div>
                                <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <div>
                                    <h3 class="card_widget_header">1538</h3>
                                    <h6 class="text-muted">Form Request tukar off</h6> </div>
                                <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather ">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                </path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="12" y1="18" x2="12" y2="12"></line>
                                <line x1="9" y1="15" x2="15" y2="15"></line>
                                </svg></span> </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body btn-light" onclick="event.preventDefault();document.getElementById('all-employees').submit();">
                            <form id="all-employees" action="/users" method="get" style="display: none;">
                            </form>
                            <div class="dash-widget-header ">
                                <div>
                                    <h3 class="card_widget_header" id="count_employees"></h3>
                                    <h6 class="text-muted">Total of Employees</h6> </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather ">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                        </path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="12" y1="18" x2="12" y2="12"></line>
                                        <line x1="9" y1="15" x2="15" y2="15"></line>
                                        </svg></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title float-left mt-2">Inquiry assigned to you
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center">
                                    <thead>
                                        <tr>
                                            <th>Request Type</th>
                                            <th>Address</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                                        <tbody id="body-list-request">

                                        </tbody>
                                </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>

    </div>

    <!-- MULAI MODAL KONFIRMASI DELETE-->
    <div class="modal fade " tabindex="-1" role="dialog" id="konfirmasi-reject-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" style="color: red">Reason to Reject!!!</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black">
                    <div class="form-group was-validated">
                        <input id="reason_reject" name="reason_reject" type="text" class="form-control @error('reason_reject') is-invalid @enderror" placeholder="Reason Reject" name="reason_reject" required autocomplete="off" value="{{ old('reason_reject') }}">
                        <div class="invalid-feedback">input data sesuai aktual</div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" name="tombol-send-reject" id="tombol-send-reject">Send</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        //CSRF TOKEN PADA HEADER
        //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // setInterval(getkontrak, 5000);

            // function getkontrak() {
            //         $.ajax({
            //             url: '/kontrak/now',
            //             type: 'GET',
            //             success: function(data) {
            //                console.log(data);
            //             }
            //         });
            //     }
            $.ajax({
                    type: 'GET',
                    url: '/count/notif',
                    success:function(data){

                        var isi_data =JSON.parse(data);
                        // console.log(isi_data[0]);
                        $('#count_leave').html(isi_data.length); //valuenya tambah pegawai baru

                        $('#body-list-request').empty();
                        isi_data.forEach(data =>
                        {
                            $('#body-list-request').append(
                            `<tr>
                                    <input type="hidden" name="id_data" id="id_data" value="${data['id']}">
                                    <th name="type_ijin" id="type_ijin">${data['type_ijin']}</th>
                                    <th name="id_peminta" id="id_peminta" >${data.peminta['name']}</th>
                                    <th name="start_date" id="start_date">${data['start_date']}</th>
                                    <th name="end_date" id="end_date">${data['end_date']}</th>
                                    <th name="leave_reason" id="leave_reason">${data['leave_reason']}</th>

                                    <th>
                                        <a href="javascript:void(0)" data-toggle="tooltip" id="${data['id']}" data-original-title="Edit" class=" btn btn-warning btn-sm reject-post">Reject</a>
                                        <a href="javascript:void(0)" data-toggle="tooltip" id="${data['id']}" data-original-title="Edit" class="edit btn btn-success btn-sm approve-post">Approve</a>
                                    </th>
                                </tr>
                            `
                            );
                        });
                        },
                    });

                    $.ajax({
                    type: 'GET',
                    url: '/user/all',
                    success:function(data){
                        var isi_data =JSON.parse(data);
                        $('#count_employees').html(isi_data.length); //valuenya tambah pegawai baru


                        },
                    });

                    $.ajax({
                    type: 'GET',
                    url: '/get/site',
                    success:function(data){
                        var isi_data =JSON.parse(data);
                        $('#count_site_project').html(isi_data.length); //valuenya tambah pegawai baru

                        },
                    });

            $(document).on('click', '.approve-post', function () {
                var data_id = $(this).attr('id');

                $.ajax({
                    type: 'GET',
                    url: '/form/ijin/approve',
                    data: {approve:"1", reject: "0", id:data_id},
                    success:function(data){

                        if(data.success){
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Request berhasil di setujui',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                                });
                            }
                            if(data.errors)
                            {
                                iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data gagal disetujui',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                            });
                            }
                        location.reload(true);

                    },
                    error:function(data){


                    }
                });

            });
            $(document).on('click', '.reject-post', function () {
                // dataId = $('#id_data').val();
            dataId = $(this).attr('id');
                $('#konfirmasi-reject-modal').modal('show');
                $('#tombol-hapus').text('Delete'); //set text untuk tombol hapus
            });


            $('#tombol-send-reject').click(function () {
                var data_reject = $('#reason_reject').val();
                $.ajax({
                    url: "/form/ijin/reject", //eksekusi ajax ke url ini
                    type: 'GET',
                    data: {
                        approve:"0",
                        reject: data_reject,
                        id: dataId},

                    success: function (data) { //jika sukses

                            $('#konfirmasi-reject-modal').modal('hide'); //sembunyikan konfirmasi modal
                        if(data.success){
                                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Request Berhasil Ditolak',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                                });
                            location.reload(true);

                            }
                            if(data.errors)
                            {
                                iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Ooops alasan kamu belum diinput',
                                message: '{{ Session('
                                success ')}}',
                                position: 'topRight'
                            });
                            }
                        },

                });
            });


        });

    </script>


@endsection

