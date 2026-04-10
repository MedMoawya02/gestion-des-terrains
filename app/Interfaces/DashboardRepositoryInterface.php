<?php
namespace App\Interfaces;
interface DashboardRepositoryInterface {
    public function getMonthlyStats($year);
    public function getCounters();
    public function getRecentReservations($limit);
    public function getReservationsHistory($search, $perPage);
}