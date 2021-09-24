<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository{
    protected $model;
    private $relations;

    public function __construct(Model $model,$relations=[])
    {
        $this->model = $model;
        $this->relations = $relations;
    }

    public function all()
    {
        $query = $this->model;
        if(!empty($this->relations)){
            $query = $query->with([$this->relations]);
        }
        return $query->paginate(10);
    }

    public function get($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data,$id)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
