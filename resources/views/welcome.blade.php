<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELL COME TO RABITLY SHOP</title>
    <!-- Menambahkan link Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #dfe3e6, #e6e8ec);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(to right, #2171f1, #f08127);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 79px;
            height: 50px;
            margin-right: 10px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .nav-links li {
            margin-left: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 16px;
            padding: 5px 10px;
            transition: color 0.3s, background-color 0.3s;
        }

        .nav-links a:hover {
            color: rgb(241, 233, 233);
            background-color: #5919c7;
            border-radius: 5px;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background: linear-gradient(to right, #e5e7eb, #f6f5f7);
        }

        .content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            position: relative;
        }

        .content img {
            width: 500px;
            height: auto;
            margin-right: 60px;
            border-radius: 10px;
            transition: transform 0.3s ease;
            position: relative;
        }

        .content img:hover {
            transform: scale(1.05);
        }

        .text-content {
            max-width: 600px;
            margin-left: 50px;
        }

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .info-section {
            margin: 30px 0;
            padding: 20px;
            border: 1px solid #fbf5f5;
            border-radius: 10px;
            background-color: #efe8e8;
            width: 80%;
            text-align: center;
        }

        .cta-btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3b35f8;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cta-btn:hover {
            background-color: #4f27c5;
        }

        footer {
            background-color: rgb(202, 200, 205);
            padding: 20px;
            text-align: center;
            color: #333;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
            margin-top: auto;
        }

        footer p {
            font-size: 16px;
            margin: 5px 0;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            color: #333;
            font-size: 20px;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #2171f1;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo">
            <span><strong>RABITLY FARM</strong></span>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/about') }}"><span class="icon">ℹ</span> ABOUT</a></li>
            <li><a href="{{ url('/contact') }}"><span class="icon">📞</span> CONTACT</a></li>
            <li><a href="{{ url('/login') }}"><span class="icon">🔑</span> LOGIN</a></li>
        </ul>
    </header>

    <main>
        <div class="content">
            <img src="{{ asset('storage/images/banner.jpg') }}" alt="Koleksi Kelinci">
            <img src="{{ asset('storage/images/baner2.jpg') }}" alt="Koleksi Kelinci">
            <div class="text-content">
                <h1>"Selamat datang di website kelinci kami!"</h1>
                <p>Jelajahi koleksi terbaru kami dan temukan kelinci yang sesuai untuk Anda.</p>
                <p>Silakan login atau daftar untuk melihat informasi lebih lanjut dan melakukan pembelian.</p>
                <a href="{{ route('login') }}" class="cta-btn">Mulai Belanja</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Website Kelinci Penjualan. All rights reserved.</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>

</body>

</html>
