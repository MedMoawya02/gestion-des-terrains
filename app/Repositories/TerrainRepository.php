<?php
namespace App\Repositories;
use App\Interfaces\TerrainRepositoryInterface;
use App\Models\Terrain;
class TerrainRepository implements TerrainRepositoryInterface
{
    public function getAllPaginated($perPage)
    {
        return Terrain::paginate($perPage);
    }
    public function getLatest($limit)
    {
        return Terrain::latest()->take($limit)->get();
    }
    public function findById($id)
    {
        return Terrain::findOrFail($id);
    }
    public function store(array $data)
    {
        return Terrain::create($data);
    }
    public function update($id, array $data)
    {
        $terrain = $this->findById($id);
        return $terrain->update($data);
    }
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}