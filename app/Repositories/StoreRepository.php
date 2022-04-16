<?php

namespace App\Repositories;

use App\Models\Course;

class StoreRepository
{
    public function getStoreProducts()
    {
        return Course::whereNotIn('id', \Auth::user()->courses()->pluck('course_id'))->paginate(15);
    }

    public function addItemToCart($value) {

    }

    public function getTotalCartValue()
    {

    }
}
