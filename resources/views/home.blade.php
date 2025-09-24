<!doctype html>
<html lang="id">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Home - Sederhana (Bootstrap 5)</title>
      <!-- Bootstrap 5 CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
         /* Styling sederhana tambahan */
         .hero {
         background: linear-gradient(120deg, #6c5ce7 0%, #00b894 100%);
         color: white;
         border-radius: .75rem;
         }
         .feature-icon {
         font-size: 2rem;
         }
      </style>
   </head>
   <body>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
         <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">Simpadu-ASN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
               <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  {{-- <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                  <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li> --}}
               </ul>
               <a class="btn btn-primary ms-lg-3" href="{{ url('/login') }}">Login / Masuk</a>
            </div>
         </div>
      </nav>
      <!-- Hero -->
      <header class="container my-5">
         <div class="p-5 hero shadow-lg">
            <div class="row align-items-center">
               <div class="col-lg-7">
                  <h1 class="display-6 fw-bold">Selamat datang di Simpadu-ASN</h1>
                  <p class="lead">Contoh halaman rumah sederhana menggunakan Bootstrap 5. Ringan, responsif, dan mudah dikustomisasi.</p>
                  <div class="mt-4">
                     <a href="#features" class="btn btn-light btn-lg me-2">Lihat Fitur</a>
                     <a href="#contact" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                  </div>
               </div>
               <div class="col-lg-5 text-center mt-4 mt-lg-0">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/Coat_of_arms_of_Southeast_Sulawesi.svg" alt="Bootstrap" width="160" class="img-fluid opacity-75">
               </div>
            </div>
         </div>
      </header>
      <!-- Features -->
      {{-- <section id="features" class="container py-5">
      <h2 class="mb-4 text-center">Fitur Utama</h2>
      <div class="row g-4">
      <div class="col-md-4">
      <div class="card h-100 shadow-sm">
      <div class="card-body text-center">
         <div class="mb-3 feature-icon">⚡</div>
         <h5 class="card-title">Cepat &amp; Ringan</h5>
         <p class="card-text">Desain fokus pada performa dan kecepatan muat halaman.</p>
      </div> --}}
</html>