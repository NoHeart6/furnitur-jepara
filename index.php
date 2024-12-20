<?php
require_once "config/config.php";
require_once "includes/header.php";
require_once "includes/navbar.php";

$totalProducts = $ProductsCollection->countDocuments();
$totalCategories = $CategoriesCollection->countDocuments();
$totalOrders = $OrdersCollection->countDocuments();
?>

<style>
    /* Modern & Attractive Styles */
    :root {
        --primary: #C5A880;
        --secondary: #1A1A1A;
        --accent: #E8D5C4;
        --text: #2D2D2D;
        --light: #FFFFFF;
        --dark: #0A0A0A;
        --gradient: linear-gradient(135deg, var(--primary), var(--accent));
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        min-height: 100vh;
        background: var(--dark);
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .overlay-gradient {
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0,0,0,0.9), rgba(0,0,0,0.5));
    }

    /* Animated Shapes */
    .animated-shapes .shape {
        position: absolute;
        border-radius: 50%;
        background: var(--gradient);
        filter: blur(60px);
        opacity: 0.3;
        animation: floatAnimation 8s infinite ease-in-out;
    }

    .shape-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -150px;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 400px;
        height: 400px;
        bottom: -200px;
        left: -200px;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 200px;
        height: 200px;
        top: 50%;
        right: 10%;
        animation-delay: 4s;
    }

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-20px) scale(1.1); }
    }

    /* Hero Content */
    .hero-content {
        position: relative;
        z-index: 2;
        padding: 2rem 0;
    }

    .hero-title {
        font-size: 4.5rem;
        font-weight: 800;
        color: var(--light);
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .hero-title .highlight {
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: block;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: var(--light);
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 500px;
    }

    /* Hero Features */
    .hero-features {
        display: flex;
        gap: 2rem;
        margin-bottom: 2.5rem;
    }

    .feature {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--light);
    }

    .feature i {
        color: var(--primary);
    }

    /* Hero Buttons */
    .hero-buttons {
        display: flex;
        gap: 1rem;
    }

    .btn-primary {
        background: var(--gradient);
        color: var(--dark);
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(197,168,128,0.3);
    }

    .btn-outline {
        border: 2px solid var(--primary);
        color: var(--light);
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline:hover {
        background: var(--primary);
        color: var(--dark);
    }

    /* Hero Image */
    .hero-image {
        position: relative;
        padding: 2rem;
    }

    .hero-image img {
        width: 100%;
        height: auto;
        animation: float 6s infinite ease-in-out;
    }

    .floating-card {
        position: absolute;
        bottom: 10%;
        right: 0;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        padding: 1.5rem;
        border-radius: 15px;
        border: 1px solid rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        gap: 1rem;
        animation: float 5s infinite ease-in-out;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark);
    }

    .card-content h4 {
        color: var(--light);
        margin: 0;
        font-size: 1.1rem;
    }

    .card-content p {
        color: var(--light);
        opacity: 0.8;
        margin: 0;
        font-size: 0.9rem;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 3.5rem;
        }
        
        .hero-features {
            flex-direction: column;
            gap: 1rem;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .floating-card {
            display: none;
        }
    }
</style>

<!-- Hero Section Modern -->
<section class="hero-section">
    <div class="hero-background">
        <div class="overlay-gradient"></div>
        <div class="animated-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>
    
    <div class="container position-relative">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Setia Furniture
                        <span class="highlight">Jepara</span>
                    </h1>
                    <p class="hero-subtitle">Hadirkan Keanggunan & Kenyamanan Dalam Setiap Ruangan Anda</p>
                    
                    <div class="hero-features">
                        <div class="feature">
                            <i class="fas fa-star"></i>
                            <span>Kualitas Premium</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-shield-alt"></i>
                            <span>Garansi Resmi</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-truck"></i>
                            <span>Pengiriman Nasional</span>
                        </div>
                    </div>

                    <div class="hero-buttons">
                        <a href="#products" class="btn-primary">
                            Jelajahi Koleksi
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#contact" class="btn-outline">
                            Hubungi Kami
                        </a>
                    </div>

                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="position-relative" style="height: 400px;">
                    <!-- Area kosong tanpa teks dan icon -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "includes/footer.php"; ?> 