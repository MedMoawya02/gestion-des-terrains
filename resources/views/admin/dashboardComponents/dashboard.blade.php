@extends('layout.layout')

@section('title', 'Tableau de Bord Admin')

@section('content')

    {{-- 1. En-tête avec Notifications --}}
    @include('admin.dashboardComponents.header')

    {{-- 2. Cartes de Statistiques (Réservations, Terrains, etc.) --}}
    @include('admin.dashboardComponents.stats_cards')

    <div class="row g-4">
        {{-- 3. Graphique de Fréquentation --}}
        <div class="col-lg-8">
            @include('admin.dashboardComponents.chart')
        </div>

        {{-- 4. Liste des Activités Récentes --}}
        <div class="col-lg-4">
            @include('admin.dashboardComponents.recent_activities')
        </div>
    </div>

    {{-- Styles spécifiques --}}
    @include('admin.dashboardComponents.styles')

@endsection