@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <style>
        .contact-section {
            background-color: #f0f4f8;
            padding: 60px 0;
            text-align: center;
        }
        .contact-section h1 {
            color: #333;
            font-weight: 700;
            font-size: 32px;
            margin-bottom: 40px;
        }
        .contact-info {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            display: inline-block;
            width: 80%;
            max-width: 600px;
            transition: transform 0.3s ease;
        }
        .contact-info:hover {
            transform: translateY(-10px);
        }
        .contact-info h4 {
            color: #007bff;
            font-weight: 600;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .contact-info p {
            color: #555;
            font-size: 16px;
            line-height: 1.8;
        }
        .contact-info p i {
            margin-right: 10px;
            color: #007bff;
        }
        .header {
            background-color: #fff; /* Example header background color */
            padding: 27px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: right; /* Aligns navigation to the right */
        }
        .header nav ul {
            list-style-type: none;
            padding: 10;
            margin: 0;
        }
        .header nav ul li {
            display: inline;
            margin-right: 20px;
        }
        .header nav ul li a {
            text-decoration: none;
            color: #f8f3f9;
            font-weight: 600;
        }
        .header nav ul li a:hover {
            color: #df1ed2;
        }
        .header nav ul li a i {
            margin-right: 5px;
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

    <div class="contact-section">
        <h1>Informasi Kontak</h1>
        <div class="contact-info">
            <h4>Hubungi Kami</h4>
            <p><i class="fas fa-map-marker-alt"></i> Desa Krasak Blok Pulo RT 24/05, Jawa Barat, Indramayu</p>
            <p><i class="fas fa-phone-alt"></i> +628 123 4567 890</p>
            <p><i class="fas fa-envelope"></i> wawan@gmail.com</p>
        </div>
    </div>
@endsection
