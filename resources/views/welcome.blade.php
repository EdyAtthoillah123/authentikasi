<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendalungan Megah Solusi</title>
    <link rel="icon" href="{{ asset('images/footer/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-transparent" color-on-scroll="400"
        style="background-color: #121212;">
        <div class="container">
            <a class="navbar-brand fira-sans-extrabold txt-primary animated-text"
                href="https://pendalunganmegahsolusi.com/" rel="tooltip" style="font-size: 36px;">TaskFlow</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link smooth-scroll txt-primary fira-sans-regular animated-text"
                            href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smooth-scroll txt-primary fira-sans-regular animated-text"
                            href="#service">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smooth-scroll txt-primary fira-sans-regular animated-text"
                            href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarCollapse = document.getElementById('navigation');

            navLinks.forEach((link) => {
                link.addEventListener('click', () => {
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                        document.querySelector('.navbar-toggler').classList.add('collapsed');
                    }
                });
            });
        });
    </script>


    <!-- Hero Section -->
    <div id="hero" class="jumbotron" style="background-color: #121212;">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 col-lg-6 txt-primary">
                    <p class="animated-text">Selamat Datang</p>
                    <h1 class="fira-sans-bold txt-primary animated-text-2" style="margin-top: 24px;">
                        Kelola Proyek Lebih Mudah
                    </h1>
                    <h1 class="fira-sans-bold txt-primary animated-text-2" style="margin-top: 24px;">
                        Bersama Tim Anda
                    </h1>
                    <h1 class="fira-sans-bold txt-primary animated-text-2" style="margin-top: 24px;">
                        Dalam Satu Platform
                    </h1>
                    <p class="txt-primary fira-sans-regular animated-text-3" style="margin-top: 24px;">
                        Platform manajemen proyek kami dirancang untuk membantu Anda mengatur tugas, memantau progres,
                        dan berkolaborasi secara efisien dengan tim Anda.
                    </p>
                    <button class="start-project-button animated-text-4" onclick="scrollToAbout()"
                        style="margin-top: 36px;">
                        Mulai Kelola Proyek
                    </button>
                </div>
                <div class="col-md-6 col-lg-6 d-flex justify-content-end">
                    <div class="jumbotron_img border-animation">
                        <img src="{{ asset('images/landing/hero.gif') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mengapa Memilih Kami -->
    <div class="section" id="testimoni">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <h1 class="fira-sans-bold">Mengapa Menggunakan Platform Kami?</h1>
                        <p class="fira-sans-regular" style="margin-top: 12px;">Meningkatkan efisiensi dan produktivitas
                            proyek Anda</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div>
                        <img src="{{ asset('images/testimoni/security.png') }}" alt="Icon">
                    </div>
                    <div class="m-3">
                        <h6 class="fira-sans-medium">Manajemen Tugas</h6>
                        <p class="card-text lead fira-sans-regular" style="font-size: 14px">
                            Atur tugas, tetapkan deadline, dan pantau kemajuan setiap anggota tim secara real-time.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <div>
                        <img src="{{ asset('images/testimoni/analysis.png') }}" alt="Icon">
                    </div>
                    <div class="m-3">
                        <h6 class="fira-sans-medium">Kolaborasi Tim</h6>
                        <p class="card-text lead fira-sans-regular" style="font-size: 14px">
                            Komunikasi dan kolaborasi lebih baik melalui komentar, notifikasi, dan pembagian file.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <div>
                        <img src="{{ asset('images/testimoni/settings.png') }}" alt="Icon">
                    </div>
                    <div class="m-3">
                        <h6 class="fira-sans-medium">Monitoring Proyek</h6>
                        <p class="card-text lead fira-sans-regular" style="font-size: 14px">
                            Pantau status proyek dan progres tugas dengan dashboard visual dan laporan otomatis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Layanan -->
    <div class="section" id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <h1 class="fira-sans-bold">Fitur Utama</h1>
                        <p class="card-text lead fira-sans-regular" style="font-size: 16px; margin-top: 12px">
                            Semua yang Anda butuhkan untuk manajemen proyek yang sukses
                        </p>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 44px;">
                <div class="col-md-4" style="margin-top: 20px;">
                    <div class="text-center shadow-sm card bg-light rounded-3" style="border: none;">
                        <div class="py-5 card-body">
                            <h5 class="fira-sans-medium">Task & Deadline</h5>
                            <p class="card-text lead" style="font-size: 14px;">
                                Buat, kelola, dan selesaikan tugas dengan tenggat waktu yang jelas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <div class="text-center shadow-sm card bg-light rounded-3" style="border: none;">
                        <div class="py-5 card-body">
                            <h5 class="fira-sans-medium">Progress Tracking</h5>
                            <p class="card-text lead" style="font-size: 14px;">
                                Visualisasikan progres proyek melalui Gantt chart atau Kanban board.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <div class="text-center shadow-sm card bg-light rounded-3" style="border: none;">
                        <div class="py-5 card-body">
                            <h5 class="fira-sans-medium">Integrasi & Notifikasi</h5>
                            <p class="card-text lead" style="font-size: 14px;">
                                Sinkronisasi dengan Google Calendar, Slack, dan dapatkan notifikasi instan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="contact" class="mt-5" style="background-color: #121212;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="txt-primary" style="margin-top: 24px;">
                        Platform manajemen proyek yang membantu tim mengelola tugas, kolaborasi, dan
                        produktivitas secara efisien. Dirancang untuk startup, bisnis kecil, hingga perusahaan besar.
                    </p>
                </div>
                <!-- Anda dapat menambahkan kolom lainnya di sini seperti menu navigasi, kontak cepat, atau newsletter -->
            </div>
        </div>
    </footer>

    <style>
        .menu-container ul {
            display: block;
        }

        /* Media query for small screens */
        @media (max-width: 768px) {
            .menu-container ul {
                display: flex;
                flex-direction: row;
                /* Change to row for horizontal layout */
                justify-content: center;
                /* Center the items */
                padding: 0;
            }

            .menu-container ul li {
                margin-bottom: 0;
                /* Remove bottom margin for horizontal layout */
                margin-right: 12px;
                /* Add right margin for spacing between items */
                list-style: none;
                /* Remove default list styling */
            }

            .menu-container ul li:last-child {
                margin-right: 0;
                /* Remove right margin from the last item */
            }

            /* Ensure links are aligned center within list items */
            .menu-container ul li a {
                display: block;
                text-align: center;
            }
        }
    </style>
</body>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
    function scrollToAbout() {
        var aboutSection = document.getElementById('about');
        aboutSection.scrollIntoView({
            behavior: 'smooth'
        });
    }
</script>

</html>
