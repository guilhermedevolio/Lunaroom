<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
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
        $packages = [250, 500];
        return view('campus.store.buy_credits', compact('packages'));
    }

    public function addToCart(Request $request) {
        Session::put('cart', $request->get('credits'));
        return response()->json(['status' => 1, 'cart' => Session::get('cart')]);
    }

    public function clearCart(Request $request) {
        Session::remove('credits');
        return response()->json(['status' => 1, 'price' => Session::get('credits') * 0.10, 'credits' => Session::get('credits')]);
    }


}
