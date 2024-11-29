<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * Create a new class instance.
     */
    private $relations;
    protected $model;
    public function __construct(Model $model,array $relations=[])
    {
        $this->model = $model;
        $this->relations = $relations;
    }

    public function index()
    {
        $query = $this->model;

        if(!empty($this->relations)) {
            $query = $query->with($this->relations);
        }

        return $query->get();
    }
    public function show(string $id)
    {
        $query = $this->model;

        if(!empty($this->relations)) {
            $query = $query->with($this->relations);
        }

        return $query->findOrFail(id: $id);
    }

    public function save(Model $model)
    {
        $model->save();
        return $model;
    }
    public function destroy(Model $model)
    {
        $model = $model->delete();
        return $model;
    }
}
