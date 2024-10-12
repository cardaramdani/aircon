<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="description" content="AirConPro menyediakan layanan service AC jakarta dan kota tangerang yang profesional dengan teknisi berpengalaman. Hubungi kami untuk layanan terbaik.">

        <title>Jasa Service AC Tangerang| AirConPro</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><i class="fa-solid fa-wind"></i> AirconPro | Jasa Service AC Tangerang</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Galery</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tips">Tips</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pricelist">Price list</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading"><h1 style="background-color: rgba(227, 221, 221, 0.587); ">Jasa Service AC Daerah Tangerang</h1></div>
                {{-- <div class="masthead-subheading"><h1 style="background-color: rgba(227, 221, 221, 0.587);">Jasa Service AC Daerah Jakarta Barat</h1></div>
                <div class="masthead-subheading"><h1 style="background-color: rgba(227, 221, 221, 0.587);">Jasa Service AC Daerah Jakarta Utara</h1></div>
                <div class="masthead-subheading"><h1 style="background-color: rgba(227, 221, 221, 0.587);">Jasa Service AC Daerah Jakarta Pusat</h1></div> --}}
                {{-- <div class="masthead-heading text-uppercase">
                   <h1>Jasa Service AC Jakarta</h1>
                </div>
                <div class="masthead-heading text-uppercase">
                    <h1>Jasa Service AC Kota tangerang</h1>
                 </div> --}}
                {{-- <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a> --}}
                {{-- <a style="background: none" class="btn btn-primary btn-xl text-uppercase" href="https://wa.me/6282298520919?text=Terimakasih%20telah%20mempercayakan%20sistem%20pendinginan%20anda%20kepada%20kami,%20kami%20akan%20selalu%20memberikan%20service%20sistem%20pendinginan%20terbaik.%20Beritahu%20kami%20masalah%20sistem%20pendinginan%20anda,%20agar%20solusi%20anda%20dapatkan" >
                    <i class="fa-brands fa-whatsapp"></i>
                </a> --}}

                {{-- <a style="background: none" href="https://wa.me/6282298520919?text=Terimakasih%20telah%20mempercayakan%20sistem%20pendinginan%20anda%20kepada%20kami,%20kami%20akan%20selalu%20memberikan%20service%20sistem%20pendinginan%20terbaik.%20Beritahu%20kami%20masalah%20sistem%20pendinginan%20anda,%20agar%20solusi%20anda%20dapatkan" class="whatsapp-link ">
                    <i class="fa-brands fa-whatsapp" style="background-color: rgb(80 68 68); border-radius:10%"></i>
                </a> --}}

                {{-- <h4 style="color: black; background-color: rgba(227, 221, 221, 0.587);" >Contact</h4> --}}

            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa-solid fa-snowflake fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Service Maintenance Berkala</h4>
                        <p class="text-muted">Cleaning Indoor, Cleaning Outdoor, Cek Tekanan Freon</p>

                    </div>

                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa-solid fa-hands fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Instalasi Baru</h4>
                        <p class="text-muted">Jasa Pemasangan Unit Baru</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa-solid fa-people-arrows fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Bongkar Pasang Instalasi</h4>
                        <p class="text-muted">Jasa Bongkar Unit Lama dan Pasang Unit Baru atau Reposisi Unit AC</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa-solid fa-dolly fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Overhoul Indoor/Outdoor Unit</h4>
                        <p class="text-muted">Jasa Overhoul Indoor atau Outdoor Unit, penggantian unit kompresor</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa-solid fa-toolbox fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Perbaikan Instalasi Pipa/Refrigerant</h4>
                        <p class="text-muted">Perbaikan dengan pengelasan pipa, perbaikan dengan pengelasan pada area indoor atau outdoor unit</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Galery</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/1.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Indoor Unit</div>
                                <div class="portfolio-caption-subheading text-muted">Cleaning Indoor Unit</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/2.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Outdoor Unit</div>
                                <div class="portfolio-caption-subheading text-muted">Cleaning Outdoor Unit</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/3.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Tambah Freon</div>
                                <div class="portfolio-caption-subheading text-muted">Penambahan Freon</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/1.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                {{-- <h4>2009-2011</h4> --}}
                                <h4 class="subheading">AirConPro</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Selamat datang di AirConPro, mitra terpercaya Anda dalam layanan dan pemeliharaan sistem pendingin udara. Dengan pengalaman bertahun-tahun dan tim profesional yang terampil, kami berdedikasi untuk memastikan sistem pendingin udara Anda beroperasi dengan performa terbaik, memberikan kenyamanan dan keandalan sepanjang tahun.
                                </p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                {{-- <h4>March 2011</h4> --}}
                                <h4 class="subheading">Misi Kami</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Di AirConPro, misi kami adalah memberikan layanan pendingin udara yang luar biasa yang melebihi ekspektasi pelanggan. Kami berupaya menyediakan solusi yang andal, efisien, dan hemat biaya yang memastikan kinerja optimal sistem HVAC Anda, meningkatkan kualitas udara dalam ruangan dan kenyamanan keseluruhan.
                                </p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Layanan Kami</h4>
                                <h4 class="subheading">Kami mengkhususkan diri dalam berbagai layanan, termasuk:

                                </h4>
                            </div>
                            <div class="timeline-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Pemeliharaan Rutin</li>
                                    <li class="list-group-item">Layanan Perbaikan</li>
                                    <li class="list-group-item">Instalasi</li>
                                    <li class="list-group-item">Peningkatan Sistem</li>
                                </ul>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/4.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                {{-- <h4>July 2020</h4> --}}
                                <h4 class="subheading">Mengapa Memilih AirConPro?</h4>
                            </div>
                            <div class="timeline-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Teknisi Ahli</li>
                                    <li class="list-group-item">Pendekatan Berfokus pada Pelanggan</li>
                                    <li class="list-group-item">Jaminan Kualitas</li>
                                    <li class="list-group-item">Ketersediaan 24/7</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li >
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/4.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                {{-- <h4>July 2020</h4> --}}
                                <h4 class="subheading">Komitmen Terhadap Keunggulan</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Di AirConPro, kami percaya pada peningkatan terus-menerus dan mengikuti perkembangan terbaru dalam industri HVAC. Komitmen kami terhadap keunggulan tercermin dalam perhatian kami terhadap detail, profesionalisme yang teguh, dan layanan superior yang kami berikan kepada setiap pelanggan.
                                </p>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="timeline-inverted">
                        <div class="timeline-image" style="background: none">
                            <a href="https://wa.me/6282298520919?text=Terimakasih%20telah%20mempercayakan%20sistem%20pendinginan%20anda%20kepada%20kami,%20kami%20akan%20selalu%20memberikan%20service%20sistem%20pendinginan%20terbaik.%20Beritahu%20kami%20masalah%20sistem%20pendinginan%20anda,%20agar%20solusi%20anda%20dapatkan" class="whatsapp-link">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </section>
        <!-- tips-->
        <section class="page-section bg-light" id="tips">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($Posts as $post)
                    <div class="col">
                        <a href="#!" class="text-decoration-none text-dark">
                            <div class="card h-100">
                                <img src="assets/img/tips.jpg" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->body }}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-body-secondary">{{ $post->created_at }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </section>

        <section class="page-section bg-light" id="pricelist">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Price List Jasa Service AC Tangerang</h2>
                </div>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($prices as $price)
                            <div class="col">
                                <div class="card h-100">
                                    <img src="assets/img/ac-split-wall.jpg" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $price->deskripsi }}</h5>
                                        <p class="card-text">{{ $price->list_pekerjaan }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-body-secondary">{{ $price->tipe }} {{ $price->kapasitas }} : Rp. {{ $price->harga }}</small>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="service_items[{{ $price->id }}][id]" value="{{ $price->id }}" id="service_{{ $price->id }}">
                                            <label class="form-check-label" for="service_{{ $price->id }}">Pilih Jasa</label>
                                           <div class="col"> <label>Qty :</label>
                                            <input type="number" class="form-control" name="service_items[{{ $price->id }}][qty]" min="1" value="1" placeholder="Jumlah">
                                        </div></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telepon:</label>
                            <input type="text" class="form-control" id="phone" name="phone" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required autocomplete="off">
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary" style="font-size: -webkit-xxx-large">Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container" >
                <div class="text-center">
                    <a style="background: none" href="https://wa.me/6282298520919?text=Terimakasih%20telah%20mempercayakan%20sistem%20pendinginan%20anda%20kepada%20kami,%20kami%20akan%20selalu%20memberikan%20service%20sistem%20pendinginan%20terbaik.%20Beritahu%20kami%20masalah%20sistem%20pendinginan%20anda,%20agar%20solusi%20anda%20dapatkan" class="whatsapp-link">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
            </div>
        </div>

        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy;  AirconPro 2024</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/airconpro_services/" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a class="btn btn-dark btn-social mx-2" href="mailto:airconpro.services@gmail.com" aria-label="Email">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                        <a class="btn btn-dark btn-social mx-2" href="https://www.tiktok.com/@airconpro_services" aria-label="Tiktok">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>

                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Cleaning Indoor Unit</h2>
                                    <p class="item-intro text-muted">Cleaning Indoor Unit Termasuk Didalam Paket Jasa Maintenance Berkala</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/1.jpg" alt="..." />
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Cleaning Outdoor Unit</h2>
                                    <p class="item-intro text-muted">Cleaning Outdoor Unit Termasuk Didalam Paket Jasa Maintenance Berkala</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/2.jpg" alt="..." />
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Penambahan Freon</h2>
                                    <p class="item-intro text-muted">Proses Penambahan Freon Dikarenakan Teknan Tidak Stanadar</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/3.jpg" alt="..." />
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <!-- Portfolio item 4 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/4.jpg" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Lines
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Branding
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 5 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/5.jpg" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Southwest
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Website Design
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 6 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/6.jpg" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Window
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Photography
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
    <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XMGPMMSK5Z"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XMGPMMSK5Z');
        </script>

</html>
