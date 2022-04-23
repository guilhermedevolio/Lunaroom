<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Repositories\StoreRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StoreController extends Controller
{
    use ResponseTrait;

    protected StoreRepository $repository;

    public function __construct(StoreRepository $repository, CourseRepository $courseRepository)
    {
        $this->repository = $repository;
        $this->courseRepository = $courseRepository;
    }

    public function viewStore(): View
    {
        $courses = $this->repository->getStoreProducts();
        return view('campus.store.store', compact('courses'));
    }

    public function summaryCart()
    {
        $totalCartValue = $this->repository->getTotalCartValue();
        $cartCourses = $this->repository->getCartCourses();
        return view('campus.store.cart', compact('totalCartValue', 'cartCourses'));
    }

    public function addItemToCart(int $courseId): JsonResponse
    {
        try {
            $this->repository->addItemCart($courseId);
            return $this->success(['ok' => true]);
        } catch (\Exception $ex) {
            return $this->error(['ok' => false, 'message' => $ex->getMessage()]);
        }
    }

    public function removeItemCart(int $courseId): JsonResponse
    {
        try {
            $this->repository->removeItemCart($courseId);
            return $this->success(['ok' => true]);
        } catch (\Exception $ex) {
            return $this->error(['ok' => false, 'message' => $ex->getMessage()]);
        }
    }

    public function UserPurchasesView()
    {
        $userSales = Auth::user()
            ->sales()
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('campus.store.user_purchases', compact('userSales'));
    }

    public function addToCart(Request $request)
    {

    }

    public function clearCart(Request $request)
    {

    }
}
