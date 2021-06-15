<?php


namespace App\Repositories;


use App\Models\Module;

class ModuleRepository
{
    protected $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function createModule($payload)
    {
        return $this->model->create($payload);
    }

    public function getModuleById($moduleId)
    {
        return $this->model->with('lessons')->findOrFail($moduleId);
    }
}
