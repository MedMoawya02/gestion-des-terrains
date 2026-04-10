@extends('layout.layout')

@section('title', 'Historique des Réservations')

@section('content')
    <div class="container-fluid py-4">

        @include('admin.historiqueComponents.header')

        {{-- section search --}}
        @include('admin.historiqueComponents.filter')

        {{-- table des reservations --}}
        @include('admin.historiqueComponents.tableReservations')
    </div>

    <style>
        .bg-success-subtle {
            background-color: #d1e7dd;
        }

        .bg-warning-subtle {
            background-color: #fff3cd;
        }

        .bg-danger-subtle {
            background-color: #f8d7da;
        }

        .table thead th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            font-weight: 700;
            color: #64748b;
        }

        .avatar-sm {
            font-weight: 700;
            font-size: 0.9rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
@endsection