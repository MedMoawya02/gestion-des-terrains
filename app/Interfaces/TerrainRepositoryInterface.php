<?php
namespace App\Interfaces;

interface TerrainRepositoryInterface {
    public function getAllPaginated($perPage);
    public function getLatest($limit);
    public function findById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}