<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Repositories\StoreRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class StoreController extends Controller
{
    protected StoreRepository $repository;

    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewStore(): View
    {
        $courses = $this->repository->getStoreProducts();
        return view('campus.store.store', compact('courses'));
    }

    public function viewBuyCredits()
    {
        return view('campus.store.buy_credits');
    }
}
