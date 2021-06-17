<?php


namespace App\Repositories;


use App\Models\Module;


class ModuleRepository
{

    protected Module $model;


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


    public function updateModule($moduleId, array $payload)
    {
        $module = $this->model->findOrFail($moduleId)->update($payload);

        return $module;
    }

    public function deleteModule($moduleId)
    {
        return $this->model->findOrFail($moduleId)->delete();
    }
}
