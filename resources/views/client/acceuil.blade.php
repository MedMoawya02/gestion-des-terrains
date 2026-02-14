@extends('layout.layout')

@section('title', 'Acceuil')
<style>
    html{
        scroll-behavior: smooth;
    }
    section {
    padding-top: 80px;
    padding-bottom: 80px;
}

.shadow-sm {
    transition: all 0.3s ease;
}

.shadow-sm:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
}

</style>
@section('content')
    <section class="py-5">
    <div class="container">
        <div class="row align-items-center">

            <!-- Texte -->
            <div class="col-lg-6">
                <h1 class="fw-bold display-5 mb-4">
                    Réservez votre terrain <span style="color:#ff7a00;">en quelques clics</span>
                </h1>

                <p class="text-muted mb-4">
                    Trouvez le terrain parfait, consultez la disponibilité en temps réel
                    et confirmez votre réservation instantanément.
                </p>

                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-lg px-4" style="background:#ff7a00;color:white;">
                        Réserver maintenant
                    </a>

                    <a href="#how" class="btn btn-outline-dark btn-lg px-4">
                        Comment ça marche
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018"
                     class="img-fluid rounded-4 shadow"
                     alt="Football field">
            </div>

        </div>
    </div>
</section>

 {{-- Section 2  --}}
<section class="py-5" style="background:white;">
    <div class="container text-center">

        <h2 class="fw-bold mb-5">Pourquoi choisir notre plateforme ?</h2>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <i class="bi bi-lightning-charge-fill fs-1 text-warning"></i>
                    <h5 class="mt-3 fw-bold">Réservation rapide</h5>
                    <p class="text-muted">
                        Réservez en moins de 2 minutes, sans complications.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <i class="bi bi-calendar-check fs-1" style="color:#ff7a00;"></i>
                    <h5 class="mt-3 fw-bold">Disponibilité en temps réel</h5>
                    <p class="text-muted">
                        Évitez les conflits grâce à un système intelligent.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <i class="bi bi-shield-lock-fill fs-1 text-success"></i>
                    <h5 class="mt-3 fw-bold">Paiement sécurisé</h5>
                    <p class="text-muted">
                        Transactions protégées et sécurisées.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- Section 3 --}}
<section id="how" class="py-5">
    <div class="container text-center">

        <h2 class="fw-bold mb-5">Comment ça marche ?</h2>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="p-4">
                    <div class="mb-3 fs-1 fw-bold" style="color:#ff7a00;">1</div>
                    <h5 class="fw-bold">Choisissez un terrain</h5>
                    <p class="text-muted">
                        Parcourez les terrains disponibles près de chez vous.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4">
                    <div class="mb-3 fs-1 fw-bold" style="color:#ff7a00;">2</div>
                    <h5 class="fw-bold">Sélectionnez date & heure</h5>
                    <p class="text-muted">
                        Consultez les disponibilités en temps réel.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4">
                    <div class="mb-3 fs-1 fw-bold" style="color:#ff7a00;">3</div>
                    <h5 class="fw-bold">Confirmez la réservation</h5>
                    <p class="text-muted">
                        Finalisez et recevez votre confirmation instantanément.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection