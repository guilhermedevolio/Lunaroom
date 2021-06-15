<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Repositories\ModuleRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use PHPUnit\Exception;

class ModuleController extends Controller
{
    protected ModuleRepository $repository;

    use ResponseTrait;

    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postModule(PostModuleRequest $request): JsonResponse
    {
        $payload = $request->validated();

        try{
            $this->repository->createModule($payload);
        } catch (Exception $e) {
            Log::critical(['ex' => $e->getMessage()]);
        }

        return $this->success();
    }

    public function getModule($moduleId): View
    {
        $module = $this->repository->getModuleById($moduleId);

        return view('admin.course.module.edit', compact('module'));
    }

    public function putModule(UpdateModuleRequest$request, $moduleId): JsonResponse
    {
        $payload = $request->validated();

        try{
            $this->repository->updateModule($moduleId, $payload);
        } catch (Exception $e) {
            Log::critical(['ex' => $e->getMessage()]);
        }

        return $this->success();
    }

    public function deleteModule($moduleId)
    {
        $this->repository->deleteModule($moduleId);

        return redirect(route('courses'));
    }
}
