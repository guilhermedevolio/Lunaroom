<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostModuleRequest;
use App\Repositories\ModuleRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $repository;

    use ResponseTrait;

    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postModule(PostModuleRequest $request)
    {
        $payload = $request->validated();

        $this->repository->createModule($payload);

        return $this->success();
    }

    public function getModule($moduleId)
    {
        $module = $this->repository->getModuleById($moduleId);
        return view('admin.course.module.edit', compact('module'));
    }
}
