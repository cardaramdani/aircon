<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>AIRCONPRO</title>
    @yield('tambahan_link')
	<link rel="stylesheet" href="{{ URL::to('assets2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets2/plugins/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets2/css/feathericon.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets2/css/style.css') }}"> </head>

	<link rel="stylesheet" type="text/css" href="{{ URL::to('assets2/css/bootstrap-datetimepicker.min.css') }}">
	<script src="{{ URL::to('assets2/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets2/js/toastr.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="index.html" class="logo"> <img src="{{ URL::to('assets2/img/logo-aircon-vektor.png') }}" width="70" height="70" alt="logo"> <span class="logoclass" >Airconpro</span> </a>

				<a href="index.html" class="logo logo-small"> <img src="{{ URL::to('assets2/img/logo-aircon-vektor.png') }}" alt="Logo" width="-61%" height="-61%"> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown noti-dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" > <i class="fe fe-bell"></i> <span class="badge badge-pill" id="span_count_notif" name="span_count_notif"></span></a>
					<div class="dropdown-menu notifications">
						{{-- <div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a href="{{route('clear-all-notif')}}" class="clear-noti"> Clear All </a> </div> --}}
						<div class="noti-content" id="list-notification">
						</div>
						<div class="topnav-dropdown-footer"> <a href="#">View all Notifications</a> </div>
					</div>
				</li>

                <li class="dropdown has-arrow">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="user-img"><img class="rounded-circle" src="{{ url('/dataIMG_user/'.Auth::user()->avatar) }}" width="25" alt="Image"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="user-header">
							<div class="avatar avatar-sm"> <img src="{{ url('/dataIMG_user/'.Auth::user()->avatar) }}" alt="User Image" class="avatar-img rounded-circle"> </div>
								<div class="user-text">
									<h6>{{Auth::user()->name}}</h6>
									<p class="text-muted mb-0">Administrator</p>
								</div>
							</div>
                            <a class="dropdown-item" href="/profile/{{Auth::user()->id}}">My Profile</a>
                            {{-- <a class="dropdown-item" href="{{ route('logout') }}">Logout</a> --}}

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </div>
                  </li>
			</ul>

		</div>
        <!-- MULAI MODAL KONFIRMASI DELETE-->
            <div class="modal fade " tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" style="color: red">Warning!!!</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="color: black">
                            <p><b>Are you sure you want to deleted...?</b></p>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- akhir MODAL KONFIRMASI DELETE-->

		@yield('menu')
        @yield('content')
	</div>

    <div class="sidebar" id="sidebar">
        <!-- Tambahkan kode ini setelah elemen sidebar -->
<div class="sidebar-overlay"></div>
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="active"> <a href="{{route('home') }}"><i class="fas fa-tv"></i><span>Dashboard</span></a> </li>
                    <li class="list-divider"></li>
                    <li class="">
                        <a href="{{route('pricelist.index') }}"><i class="fas fa-suitcase"></i> <span>Price List AC</span></a>
                    </li>
                    <li class="">
                        <a href="{{route('posts.index') }}"><i class="fas fa-file-invoice"></i><span>Article</span></a>
                    </li>
                    <li class="submenu"> <a href="#"><i class="fas fa-calendar-alt"></i> <span> Work Schedule </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href="route('form/allcustomers/page') }}"> House Keeping</a></li>
                            <li><a href=" url('form/customer/edit/') }}"> Engineering </a></li>
                            <li><a href="route('form/addcustomer/page') }}"> Tenant Relation</a></li>
                            <li><a href="route('form/addcustomer/page') }}"> Finance Acounting</a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="fas fa-tools"></i> <span> Form Preventive </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href="{{ url('/ac')}}">Ac </a></li>
                            <li><a href="{{ url('/cwt')}}"> Clean Water Tank </a></li>
                            <li><a href="{{ url('/fan')}}"> EF & IF </a></li>
                            <li><a href="{{ url('/pmfirealarm')}}"> Fire Alarm </a></li>
                            <li><a href="{{ url('/pmfirepump')}}"> Fire Pump </a></li>
                            <li><a href="{{ url('/pmgenset')}}"> Genset </a></li>
                            <li><a href="{{ url('/gondola')}}"> Gondola </a></li>
                            <li><a href="{{ url('/hydrant')}}"> Hydrant Box </a></li>
                            <li><a href="{{ url('/pmpanel')}}"> Panel Power </a></li>
                            <li><a href="{{ url('/pmpompa')}}"> Pumps </a></li>
                            <li><a href="{{ url('/rooftank')}}"> Roof Tank </a></li>
                            <li><a href="{{ url('/pmstp')}}"> STP </a></li>
                            <li><a href="{{ url('/toilet')}}"> Toilet </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="fas fa-tasks"></i> <span> Form Logsheet </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                                    <li><a href="{{ url('/amr')}}"><i class="fas fa-bolt"></i><span>AMR</span></a></li>
                                    <li><a href="{{ url('/boosterpump')}}"><i class="fas fa-atom"></i><span>Booster Pump</span></a></li>
                                    <li><a href="{{ url('/firepump')}}"><i class="fas fa-fire-extinguisher"></i><span>Fire Pump</span></a></li>
                                    <li><a href="{{ url('/genset')}}"><i class="fas fa-oil-can"></i><span>Genset</span></a></li>
                                    <li><a href="{{ url('/logbook')}}"><i class="fas fa-book"></i><span>LogBooks</span></a></li>
                                    <li><a href="{{ url('/pdam')}}"><i class="fas fa-tint"></i><span>PDAM</span></a></li>
                                    <li><a href="{{ url('/powerhouse')}}"><i class="fas fa-charging-station"></i><span>Power House</span></a></li>
                                    <li><a href="{{ url('/stp')}}"><i class="fas fa-water"></i><span>STP</span></a></li>
                                    <li><a href="{{ url('/sumpitpump')}}"><i class="fas fa-atom"></i><span>Sumpit Pump</span></a></li>
                                    <li><a href="{{ url('/transferpump')}}"><i class="fas fa-atom"></i><span>Transfer Pump</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="fas fa-bolt"></i> <span> Utilities </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href="{{ url('/watermeterunit')}}"><i class="fas fa-tint"></i><span>Water Meter Unit</span></a></li>
                            <li><a href="{{ url('/kwhunit')}}"><i class="fas fa-bolt"></i><span>Kwh Meter Unit</span></a></li>
                            <li><a href="{{ url('/kwhcomersile')}}"><i class="fas fa-bolt"></i><span>Kwh Meter Comersile</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="fas fa-building"></i> <span> Building Data </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href="{{ url('/data')}}"><span>Data</span></a></li>
                            <li><a href="{{ url('/building-data')}}"><span>Building Data</span></a></li>
                            <li><a href="{{ url('/lisensi')}}"><span>Lisensi</span></a></li>



                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="fas fa-users"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                            <li>
                                <li><a href="/users">Employees List</a></li>

                            <li>
                                <form id="users" action="/users" method="GET" style="display: none;">
                                    {{-- @csrf --}}
                                </form>
                            {{-- <li><a href="{{route('ijin.index.all') }}">Leaves </a></li> --}}
                            {{-- <li><a href="holidays.html">Holidays </a></li> --}}
                            {{-- <li><a href="attendance.html">Attendance </a></li> --}}
                        </ul>
                    </li>

                    <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span>Management Staff </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">

                            <li>
                                <li><a href="/rolepreset">Role Presets</a></li>

                            <li><a href="#" onclick="event.preventDefault();
                                document.getElementById('permissionpreset').submit();"></i><span>Permission Presets</span></a><li>
                            <form id="permissionpreset" action="/permissionpreset" method="get" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>

                    <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href="invoices.html">Invoices </a></li>
                            <li><a href="payments.html">Payments </a></li>
                            <li><a href="expenses.html">Expenses </a></li>
                            <li><a href="taxes.html">Taxes </a></li>
                            <li><a href="provident-fund.html">Provident Fund </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="fas fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul class="submenu_class" style="display: none;">
                            {{-- <li><a href="salary.html">Employee Salary </a></li> --}}
                            {{-- <li><a href="{{route('slipgaji.index') }}">Payslip (admin)</a></li> --}}
                            <li><a href="/bpjs">Bpjs</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="fa fa-user-plus"></i>
                            <span>Management Project</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="submenu_class" style="display: none;">
                            {{-- <li><a href="{{route('siteproject.index') }}">Site Project</a></li>
                            <li><a href="{{route('department.index') }}">Department on Site</a></li> --}}
                        </ul>
                    </li>
                </ul>
                <ul>
                </ul>
            </div>
        </div>
    </div>
	{{-- <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
	{{-- <script src="{{ URL::to('assets2/js/jquery-3.5.1.min.js') }}"></script> --}}
	<script src="{{ URL::to('assets2/js/popper.min.js') }}"></script>
	{{-- <script src="{{ URL::to('assets2/js/bootstrap.min.js') }}"></script> --}}
	<script src="{{ URL::to('assets2/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ URL::to('assets2/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ URL::to('assets2/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets2/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ URL::to('assets2/js/script.js') }}"></script>
	<script src="{{ URL::to('assets2/js/moment.min.js') }}"></script>
	{{-- <script src="{{ URL::to('assets2/plugins/morris/morris.min.js') }}"></script> --}}
	{{-- <script src="{{ URL::to('assets2/js/chart.morris.js') }}"></script> --}}
    {{-- <<..sweet alert javascrip..>> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"
    integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>
    {{-- <<..sweet alert javascrip..>> --}}
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
	@yield('script')

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
    integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script src="{{URL::to('assets1/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{URL::to('assets1/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    //ini panggil jumlah notif
    <script type="text/javascript">
    // Script untuk sidebar toggle
        $(document).ready(function() {
            // Toggle untuk mobile menu
            $(document).on('click', '#mobile_btn', function(e) {
                e.preventDefault();
                $('body').toggleClass('slide-nav');
                $('.sidebar-overlay').toggleClass('opened');
                $('html').addClass('menu-opened');
                return false;
            });

        });

         function loadDoc()
            {
                setInterval(function()
                {
                    $.ajax({
                    type: 'GET',
                    url: '/count/notif',
                    success:function(data){
                        // // console.log(data);
                        var isi_data =JSON.parse(data);
                        var jumlah = $(isi_data).length;
                        $('#list-notification').empty();
                        $('#span_count_notif').empty();
                        $('#span_count_notif').append(jumlah);
                        isi_data.forEach(data =>
                        {
                            $('#list-notification').append(
                            `<a href="/home" >request pada ${data['start_date']} dari ${data['peminta']["name"]}
                            </a>`
                            );
                        });
                        },
                    });

                },
                1000);
            }
        // loadDoc();

    </script>
    <script>

            var firebaseConfig = {
                apiKey: "AIzaSyBRfsdRFhw84NGBxMlfZUQZKYvKxv3NqLY",
                authDomain: "laravel-realtime-notif.firebaseapp.com",
                projectId: "laravel-realtime-notif",
                storageBucket: "laravel-realtime-notif.appspot.com",
                messagingSenderId: "1022688349135",
                appId: "1:1022688349135:web:762286422fb114b9d3e0ba",
                measurementId: "G-M839PYNMM4"
            };

            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();

            function initFirebaseMessagingRegistration()
            {
                    messaging
                    .requestPermission()
                    .then(function () {
                        return messaging.getToken()
                    })
                    .then(function(token) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            data: {
                                token: token,
                                device_name: "web"
                            },
                            dataType: 'JSON',
                            success: function (response) {
                                alert('Youre subscribed notification successfully.');
                            },
                            error: function (err) {
                                console.log('User Chat Token Error'+ err);
                            },
                        });

                    }).catch(function (err) {
                        // console.log('User Chat Token Error'+ err);
                    });
             }

            messaging.onMessage(function(payload) {
                const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(noteTitle, noteOptions);
            });

        </script>



</body>

</html>
