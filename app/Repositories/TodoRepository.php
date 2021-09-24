<?php
namespace App\Repositories;

use App\Todo;

class TodoRepository extends BaseRepository{
    public function __construct(Todo $todo)
    {
        parent::__construct($todo);
    }
}
