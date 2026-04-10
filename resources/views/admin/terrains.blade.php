@extends('layout.layout')
<style>
    .card {
        transition: all 0.35s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .card-img-top {
        transition: transform 0.4s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }
</style>

@section('title', 'Créer un terrain')

@section('content')

    <div class="container-fluid py-4">

        <!-- Header -->
        @include('admin.terrainsComponents.header')
        <!-- Card -->
        @include('admin.terrainsComponents.addTerrain')
        <!-- Derniers Terrains (Premium Static Test) -->
 
        @include('admin.terrainsComponents.dernieresTerrains')



    </div>

@endsection