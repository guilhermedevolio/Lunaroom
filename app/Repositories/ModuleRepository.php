<?php


namespace App\Repositories;


use App\Models\Module;

/**
 * Class ModuleRepository
 * @package App\Repositories
 */
class ModuleRepository
{
    /**
     * @var Module
     */
    protected Module $model;

    /**
     * ModuleRepository constructor.
     * @param Module $model
     */
    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    /**
     * @param $payload
     * @return mixed
     */
    public function createModule($payload)
    {
        return $this->model->create($payload);
    }

    /**
     * @param $moduleId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getModuleById($moduleId)
    {
        return $this->model->with('lessons')->findOrFail($moduleId);
    }

    /**
     * @param $moduleId
     * @param array $payload
     * @return mixed
     */
    public function updateModule($moduleId, array $payload)
    {
        $module = $this->model->findOrFail($moduleId);

        return $module->update($payload);
    }

    /**
     * @param $moduleId
     * @return mixed
     */
    public function deleteModule($moduleId)
    {
        return $this->model->findOrFail($moduleId)->delete();
    }
}
