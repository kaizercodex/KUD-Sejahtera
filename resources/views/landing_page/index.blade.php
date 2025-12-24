<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Koperasi Terpercaya untuk Kesejahteraan Bersama</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Landing CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom_landing.css') }}">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="logo">{{ config('app.name') }}</div>
            <button class="mobile-menu-btn" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#features">Layanan</a></li>
                <li><a href="#why">Keunggulan</a></li>
                <li><a href="#testimonials">Testimoni</a></li>
                <li><a href="{{ route('login') }}" class="btn btn-primary">Masuk</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content" data-aos="fade-right">
                <h1>Wujudkan Impian Bersama Koperasi Sejahtera</h1>
                <p>Bergabunglah dengan ribuan anggota yang telah merasakan manfaat simpan pinjam yang aman, transparan, dan menguntungkan untuk masa depan yang lebih cerah.</p>
                <div class="hero-buttons">
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar Sekarang</a>
                    <a href="#features" class="btn btn-outline">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <img src="{{ asset('images/hero_illustration.png') }}" alt="Koperasi Illustration">
                <div class="stats-float stat-1" data-aos="fade-up" data-aos-delay="200">
                    <h3>5000+</h3>
                    <p>Anggota Aktif</p>
                </div>
                <div class="stats-float stat-2" data-aos="fade-up" data-aos-delay="400">
                    <h3>15 Tahun</h3>
                    <p>Pengalaman</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>Berbagai layanan keuangan yang dirancang khusus untuk memenuhi kebutuhan Anda</p>
            </div>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <h3>Simpanan</h3>
                    <p>Simpan uang Anda dengan aman dan dapatkan bunga yang kompetitif. Berbagai pilihan simpanan tersedia sesuai kebutuhan Anda.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3>Pinjaman</h3>
                    <p>Dapatkan pinjaman dengan bunga rendah dan proses yang cepat. Kami siap membantu mewujudkan rencana Anda.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Investasi</h3>
                    <p>Kembangkan dana Anda melalui program investasi yang menguntungkan dan terpercaya dengan risiko yang terkelola.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Konsultasi</h3>
                    <p>Tim ahli kami siap memberikan konsultasi keuangan untuk membantu Anda membuat keputusan finansial yang tepat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose" id="why">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Kepercayaan dan kepuasan anggota adalah prioritas utama kami</p>
            </div>
            <div class="why-grid">
                <div class="why-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Terdaftar dan diawasi oleh otoritas keuangan, menjamin keamanan dana Anda</p>
                </div>
                <div class="why-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="why-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Proses Cepat</h3>
                    <p>Layanan digital yang memudahkan transaksi kapan saja dan di mana saja</p>
                </div>
                <div class="why-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="why-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Berorientasi Anggota</h3>
                    <p>Keuntungan dikembalikan kepada anggota dalam bentuk SHU (Sisa Hasil Usaha)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="statistics">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
                    <span class="stat-number" data-target="5000">0</span>
                    <span class="stat-label">Anggota Aktif</span>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
                    <span class="stat-number" data-target="50">0</span>
                    <span class="stat-label">Miliar Dana Kelola</span>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
                    <span class="stat-number" data-target="10000">0</span>
                    <span class="stat-label">Pinjaman Tersalurkan</span>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="400">
                    <span class="stat-number" data-target="15">0</span>
                    <span class="stat-label">Tahun Berpengalaman</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Apa Kata Mereka?</h2>
                <p>Testimoni dari anggota yang telah merasakan manfaat bergabung dengan kami</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <p class="testimonial-text">Proses pinjaman sangat cepat dan mudah. Bunga yang ditawarkan juga sangat kompetitif. Sangat membantu untuk mengembangkan usaha saya.</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">BH</div>
                        <div class="author-info">
                            <h4>Budi Hartono</h4>
                            <p>Pengusaha UMKM</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <p class="testimonial-text">Simpanan di koperasi ini memberikan bunga yang lebih baik daripada bank. Pelayanannya juga ramah dan profesional.</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">SP</div>
                        <div class="author-info">
                            <h4>Siti Purnama</h4>
                            <p>Ibu Rumah Tangga</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                    <p class="testimonial-text">Sudah 5 tahun menjadi anggota dan sangat puas. SHU yang dibagikan setiap tahun sangat membantu keluarga kami.</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">AW</div>
                        <div class="author-info">
                            <h4>Ahmad Wijaya</h4>
                            <p>Karyawan Swasta</p>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container" data-aos="zoom-in">
            <h2>Siap Bergabung dengan Kami?</h2>
            <p>Mulai perjalanan finansial Anda bersama koperasi yang terpercaya</p>
            <a href="{{ route('register') }}" class="btn btn-light">Daftar Gratis Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <h3>{{ config('app.name') }}</h3>
                    <p>Koperasi terpercaya yang telah melayani ribuan anggota selama lebih dari 15 tahun. Kami berkomitmen untuk memberikan layanan keuangan terbaik untuk kesejahteraan bersama.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#features">Simpanan</a></li>
                        <li><a href="#features">Pinjaman</a></li>
                        <li><a href="#features">Investasi</a></li>
                        <li><a href="#features">Konsultasi</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Perusahaan</h4>
                    <ul>
                        <li><a href="#why">Tentang Kami</a></li>
                        <li><a href="#testimonials">Testimoni</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Bantuan</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <span id="year"></span> {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    element.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            };

            updateCounter();
        }

        // Trigger counter animation when in viewport
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.stat-number');
                    counters.forEach(counter => {
                        if (counter.textContent === '0') {
                            animateCounter(counter);
                        }
                    });
                }
            });
        }, observerOptions);

        const statsSection = document.querySelector('.statistics');
        if (statsSection) {
            observer.observe(statsSection);
        }

        // Set current year
        document.getElementById('year').textContent = new Date().getFullYear();

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
