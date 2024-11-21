@extends('layouts.app')

@section('title', 'About')

@section('content')
    <style>
        .header {
            background-color: #fff; /* Header background color */
            padding: 27px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: right; /* Aligns navigation to the right */
        }
        .header nav ul {
            list-style-type: none;
            padding: 0; /* Ensure no padding */
            margin: 0;
        }
        .header nav ul li {
            display: inline;
            margin-right: 20px;
        }
        .header nav ul li a {
            text-decoration: none;
            color: #f8f3f9; /* Link color */
            font-weight: 600;
        }
        .header nav ul li a:hover {
            color: #df1ed2; /* Link hover color */
        }
        .header nav ul li a i {
            margin-right: 5px; /* Space between icon and text */
        }
        .about-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1 {
            color: #3b5998;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #4a4a4a;
            margin-top: 20px;
        }
        p {
            margin: 10px 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            margin: 5px 0;
        }
        a {
            color: #3b5998; /* Link color */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .map-container {
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
    </style>

<!-- Header -->
<header class="header">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <div class="flex items-center">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Rabbitly Farm" class="h-10">
            <span class="ml-2 font-semibold text-xl text-white">Rabbitly Farm</span>
        </div>
        <nav>
            <ul class="flex space-x-4 text-white">
                <li><a href="{{ url('/dashboard') }}" class="hover:underline"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ url('/about') }}" class="hover:underline"><i class="fas fa-info-circle"></i> About</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:underline"><i class="fas fa-envelope"></i> Contact</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:underline">
                        <i class="fas fa-sign-out-alt" title="Logout"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>


    <div class="about-container">
        <h1>Tentang Toko Kami</h1>
        <p>
            Selamat datang di Toko Kelinci Sejahtera! Kami adalah penyedia kelinci berkualitas tinggi yang menawarkan berbagai jenis kelinci yang siap menjadi teman setia Anda.
        </p>
        <p>
            Di Toko Kelinci Sejahtera, kami memahami bahwa setiap kelinci layak mendapatkan perawatan yang baik dan penuh cinta.
            Semua kelinci yang kami jual dibesarkan dengan baik dalam lingkungan yang sehat dan penuh kasih sayang.
        </p>
        <p>
            Kami menyediakan berbagai jenis kelinci, mulai dari kelinci anggora yang berbulu lebat hingga kelinci holland lop yang lucu.
            Setiap kelinci disertai informasi mengenai perawatan dan kebutuhan khusus mereka.
        </p>

        <h2>Hubungi Kami</h2>
        <p>
            Jika Anda memiliki pertanyaan atau ingin tahu lebih lanjut tentang produk kami, silakan hubungi kami melalui detail berikut:
        </p>
        <ul>
            <li>Email: <a href="mailto:info@tokokelinci.com">info@tokokelinci.com</a></li>
            <li>Telepon: +628 123 4567 890</li>
            <li>Alamat: Jl. Kelinci No. 123, Indramayu, Jawa Barat, Indonesia</li>
        </ul>

        <h2>Lokasi Kami</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.984388106492!2d108.32438421415107!3d-6.318617395226632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b3c4d3f5744b%3A0xf13350f51ff0ec9f!2sJl.%20Kelinci%20No.123%2C%20Indramayu%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1635438896953!5m2!1sid!2sid"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
        <p>
            Klik pada peta untuk mendapatkan arah menuju lokasi kami.
        </p>
    </div>
@endsection
