@extends('layout.layout')

@section('title', 'Tableau de Bord Admin')

@section('content')

    <div class="mb-4 d-flex align-items-center justify-content-between">
        <div>
            <h2 class="fw-bold mb-0">Dashboard</h2>
            <p class="text-muted mb-0">Statistiques en temps réel de la plateforme</p>
        </div>

        <div class="position-relative cursor-pointer">
            <i class="bi bi-bell fs-4 text-secondary"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3
            </span>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Réservations</h6>
                        <h4 class="fw-bold mb-0">{{ $totalReservations ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-success bg-opacity-10 text-success rounded-circle p-3">
                        <i class="bi bi-map fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Terrains</h6>
                        <h4 class="fw-bold mb-0">{{ $totalTerrains ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-warning bg-opacity-10 text-warning rounded-circle p-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Clients</h6>
                        <h4 class="fw-bold mb-0">{{ $totalClients ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-danger bg-opacity-10 text-danger rounded-circle p-3">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Revenus</h6>
                        <h4 class="fw-bold mb-0">{{ number_format($totalRevenus ?? 0, 0, ',', ' ') }} DH</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Fréquentation Mensuelle</h5>
                        <div class="badge bg-light text-dark rounded-pill px-3 py-2 border">Année {{ date('Y') }}</div>
                    </div>
                    <div style="height: 350px;">
                        <canvas id="reservationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Dernières Activités</h5>
                    <div class="timeline">
                        @forelse($recentReservations as $res)
                            <div class="d-flex mb-4">
                                <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3 h-100">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Réservation de {{ $res->user->name ?? 'Client' }}</p>
                                    <small class="text-muted d-block">
                                        {{ $res->terrain->nom ?? 'Terrain' }} - {{ $res->heure_debut }}
                                    </small>
                                    <small class="text-primary fw-semibold">
                                        {{ $res->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted italic">Aucune activité récente</p>
                            </div>
                        @endforelse
                    </div>

                    <a href="{{ route('historique') }}"
                        class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">
                        Voir tout l'historique
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('reservationsChart').getContext('2d');

            // Création du dégradé (Gradient)
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(13, 110, 253, 0.3)'); // Bleu primaire transparent
            gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels ?? ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc']) !!},
                    datasets: [{
                        label: 'Réservations',
                        data: {!! json_encode($data ?? [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]) !!},
                        borderColor: '#0d6efd',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4, // Rend la ligne courbe (Smooth)
                        pointRadius: 5,
                        pointBackgroundColor: '#0d6efd',
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }, // On cache la légende pour un look plus clean
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .card {
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }
    </style>

@endsection