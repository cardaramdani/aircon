

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
                            <h1 style="font-weight: bold; margin-left: 15px;">Articles</h1>
                        </div>
                        <div class="btn-group col-md-4" role="group" aria-label="Basic example">
                            <button type="button" class="btn-create-data btn btn-secondary " id="tombol-tambah"><i class="fas fa-folder-plus"></i>Add New Article</button>
                        </div>
                    </div>
                        <!-- AKHIR DATE RANGE PICKER -->
                </div>
                <div class="panel">
                    <div class="row row-cols-1 row-cols-md-3 g-4" id="post-cards">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="tambah-modal-post" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content " style="background-color: #1f1f1ef0; color:#1ab394;">
                <div class="modal-header">
                    <h2 class="modal-title" id="modal-judul-post"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah" name="form-tambah" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="user_id" id="user_id">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" role="title"  placeholder="Enter title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                </div>

                                <div class="form-group">
                                    <input name="slug" id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" role="slug"  placeholder="Enter slug" value="{{ old('slug') }}" required autocomplete="slug" autofocus>
                                </div>

                                <div class="form-group">
                                    <textarea name="body" id="body" cols="60" rows="10"></textarea>
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

    <table id="datatable" class="display" style="display:none;">
        <thead>
            <tr>
                <th>Title</th>
                <th>Body</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

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

            function load_data(from_date = '', to_date = '') {
                $.ajax({
                    url: "{{ route('posts.index') }}",
                    method: 'GET',
                    data: {from_date: from_date, to_date: to_date},
                    dataType: 'json',
                    success: function(data) {
                        let postCards = '';
                        $.each(data.data, function(key, post) {
                            postCards += `
                            <div class="col-md-4 mb-4">
                            <div class="card" style="background-color: #020b7414; border: outset; border-radius: 10px">
                                <img src="assets/img/tips.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">${post.title}</h5>
                                    <p class="card-text">${post.body}</p>
                                    <p class="card-text"><small class="text-body-secondary">${post.published_at}</small></p>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm edit" data-id="${post.id}">Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="${post.id}">Delete</a>
                                </div>
                            </div>
                        </div>
                            `;
                        });
                        $('#post-cards').html(postCards);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
        //TOMBOL TAMBAH DATA
        //jika tombol-tambah diklik maka
        $('#tombol-tambah').click(function () {
            // $('#button-simpan').val("create-post"); //valuenya menjadi create-post
            $('#id').val(''); //valuenya menjadi kosong
            $('#form-tambah').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul-post').html("Add Article"); //valuenya tambah pegawai baru
            $('#tambah-modal-post').modal('show'); //modal tampil
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
                        url: "{{ route('posts.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON

                        success: function (data) { //jika berhasil
                            console.log(data);
                            $('#post-cards').trigger("reset"); //form reset
                            $('#tambah-modal-post').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#table_article').dataTable(); //inialisasi datatable
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
        $('body').on('click', '.edit', function () {
            var data_id = $(this).data('id');
            console.log(data_id);
            $.get('blog/edit/' + data_id,
            function (data) {
                console.log(data);
                $('#modal-judul-post').html("Update Article");
                $('#btn-name').html("update"); //valuenya tambah
                $('#tombol-simpan').val("edit-post");
                // $('#edit-modal').modal('show');
                $('#tambah-modal-post').modal('show'); //modal tampil

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
                $('#id').val(data.id);
                $('#user_id').val(data.user_id);
                $('#title').val(data.title);
                $('#body').val(data.body);
                $('#slug').val(data.slug);

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
                url: "blog/delete/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Deleting'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses

                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table_article').dataTable();
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

