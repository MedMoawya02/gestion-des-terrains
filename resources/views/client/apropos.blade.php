@extends('layout.layout')

@section('title', 'À propos')

@section('content')

    <style>
        .section-padding {
            padding: 100px 0;
        }

        .hero-about {
            background: linear-gradient(135deg, #fffaf3, #fff1dc);
        }

        .float {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .highlight {
            color: #ff7a00;
        }

        .card-modern {
            border: none;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(.25, .8, .25, 1);
        }

        .card-modern:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08);
        }

        .stats-box h2 {
            font-weight: bold;
            color: #ff7a00;
        }

        .cta-section {
            background: linear-gradient(-45deg, #ff7a00, #ff9f43, #ff7a00, #ffb66e);
            color: white;
            background-size: 300% 300%;
            border-radius: 30px;
            animation: gradientMove 8s ease infinite;
        }
        @keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
        .btn-orange {
            background: white;
            color: #ff7a00;
            font-weight: 600;
            border-radius: 30px;
            padding: 12px 30px;
        }

        .btn-orange:hover {
            background: #f5f5f5;
        }
    </style>

    <!-- ================= HERO ================= -->
    <section class="hero-about section-padding">
        <div class="container text-center">

            <h1 class="display-4 fw-bold mb-4">
                Notre mission : <span class="highlight">Simplifier la réservation</span>
            </h1>

            <p class="lead text-muted mx-auto" style="max-width:700px;">
                Nous connectons les joueurs aux meilleurs terrains sportifs
                grâce à une plateforme simple, rapide et intelligente.
            </p>

        </div>
    </section>

    <!-- ================= HISTOIRE ================= -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <img src="{{ asset('images/about.jpg') }}" class="img-fluid rounded-4 shadow float" alt="football">
                </div>

                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Notre Histoire</h2>
                    <p class="text-muted">
                        Tout a commencé avec un problème simple :
                        trouver un terrain disponible sans passer des appels interminables.
                    </p>

                    <p class="text-muted">
                        Nous avons donc créé une solution digitale moderne
                        qui permet de réserver en quelques clics,
                        avec une visibilité en temps réel.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= NOS VALEURS ================= -->
    <section class="section-padding bg-white">
        <div class="container text-center">

            <h2 class="fw-bold mb-5">Nos Valeurs</h2>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card-modern p-4 shadow-sm h-100">
                        <i class="bi bi-lightning-charge-fill fs-1 text-warning"></i>
                        <h5 class="mt-3 fw-bold">Simplicité</h5>
                        <p class="text-muted">
                            Une expérience claire et intuitive pour tous.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-modern p-4 shadow-sm h-100">
                        <i class="bi bi-shield-lock-fill fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">Sécurité</h5>
                        <p class="text-muted">
                            Des réservations et paiements protégés.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-modern p-4 shadow-sm h-100">
                        <i class="bi bi-people-fill fs-1" style="color:#ff7a00;"></i>
                        <h5 class="mt-3 fw-bold">Engagement</h5>
                        <p class="text-muted">
                            Une équipe dédiée à la satisfaction client.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= NOS CHIFFRES ================= -->
    <section class="section-padding text-center">
        <div class="container">

            <h2 class="fw-bold mb-5">Nos Chiffres</h2>

            <div class="row g-4 stats-box">

                <div class="col-md-3">
                    <h2 class="counter" data-target="500">0</h2>
                    <p class="text-muted">Réservations</p>
                </div>

                <div class="col-md-3">
                    <h2 class="counter" data-target="200">0</h2>
                    <p class="text-muted">Clients satisfaits</p>
                </div>

                <div class="col-md-3">
                    <h2 class="counter" data-target="98">0</h2>
                    <p class="text-muted">Taux satisfaction %</p>
                </div>

                <div class="col-md-3">
                    <h2 class="counter" data-target="24">0</h2>
                    <p class="text-muted">Support (heures)</p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= CTA FINAL ================= -->
    <section class="section-padding">
        <div class="container">

            <div class="cta-section text-center p-5">

                <h2 class="fw-bold mb-3">
                    Prêt à réserver votre terrain ?
                </h2>

                <p class="mb-4">
                    Rejoignez notre plateforme et jouez sans complications.
                </p>

                <a href="#" class="btn btn-orange">
                    Voir les terrains
                </a>

            </div>

        </div>
    </section>

    <!-- ================= SCRIPT ANIMATION COUNTER ================= -->
    <script>
        const counters = document.querySelectorAll('.counter');

        counters.forEach(counter => {
            const updateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / 100;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.innerText = target;
                }
            };

            updateCounter();
        });
    </script>

@endsection