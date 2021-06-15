<?php


namespace App\Repositories;


use App\Models\Module;

/**
 * Class ModuleRepository
 * @package App\Repositories
 */
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
        $module = $this->model->findOrFail($moduleId);

        return $module->update($payload);
    }

    public function deleteModule($moduleId)
    {
        return $this->model->findOrFail($moduleId)->delete();
    }
}
