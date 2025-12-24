<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>Register - {{ config('app.name') }}</title>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Custom Landing CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom_landing.css') }}">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-container">
      <a href="{{ url('/') }}" class="logo">{{ config('app.name') }}</a>
      <button class="mobile-menu-btn" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
      </button>
      <ul class="nav-links" id="navLinks">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li><a href="{{ route('login') }}">Masuk</a></li>
        <li><a href="{{ route('register') }}">Daftar</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="main-content">
    <div class="register-container">
      <div class="register-card">
        <div class="register-header">
          <h1>Bergabung dengan Kami</h1>
          <p>Buat akun baru untuk memulai perjalanan Anda</p>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
          @csrf
          
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input 
              type="text" 
              name="name" 
              id="name"
              class="form-control" 
              placeholder="Masukkan nama lengkap Anda" 
              value="{{ old('name') }}" 
              required 
              autofocus
            >
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input 
              type="text" 
              name="username" 
              id="username"
              class="form-control" 
              placeholder="Pilih username unik" 
              value="{{ old('username') }}" 
              required
            >
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input 
              type="email" 
              name="email" 
              id="email"
              class="form-control" 
              placeholder="nama@email.com" 
              value="{{ old('email') }}" 
              required
            >
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input 
              type="password" 
              name="password" 
              id="password"
              class="form-control" 
              placeholder="Minimal 8 karakter" 
              required
            >
          </div>

          <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input 
              type="password" 
              name="password_confirmation" 
              id="password_confirmation"
              class="form-control" 
              placeholder="Masukkan ulang password Anda" 
              required
            >
          </div>

          <div class="form-check">
            <input type="checkbox" name="terms" id="terms" required>
            <label for="terms">
              Saya setuju dengan <a href="#">Syarat dan Ketentuan</a> yang berlaku
            </label>
          </div>

          <button type="submit" class="btn btn-primary">Daftar Sekarang</button>

          <p class="text-center text-sm mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary">Masuk di sini</a>
          </p>
        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    © <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}. All rights reserved.
  </footer>

  <script>
    function toggleMenu() {
      const navLinks = document.getElementById('navLinks');
      navLinks.classList.toggle('active');
    }
  </script>
</body>

</html>
