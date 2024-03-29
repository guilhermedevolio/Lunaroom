<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Session;

class StoreRepository
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getStoreProducts()
    {
        return Course::whereNotIn('id', \Auth::user()->courses()->pluck('course_id'))->paginate(15);
    }

    public function addItemCart(int $courseId): bool
    {
        if (!Session::has('cart')) {
            Session::put('cart', array());
        }

        $course = $this->courseRepository->getCourseById($courseId);

        if (!$course) {
            throw new \Exception('The informed product is invalid');
        }

        $cart = Session::get('cart');

        if (!isset($cart[$courseId])) {
            $cart[$course->id] = [
                'course_id' => $course->id,
                'name' => $course->name,
                'price' => $course->price,
                'qtd' => 1
            ];

            Session::put('cart', $cart);
        }


        return true;
    }

    public function removeItemCart(int $courseId): bool
    {
        $cart = Session::get('cart');
        unset($cart[$courseId]);
        Session::put('cart', $cart);
        return true;
    }

    public function getTotalCartValue(): float
    {
        return array_sum(array_column(Session::get('cart'), 'price'));
    }

    public function getCartCourses()
    {
        $coursesCart = array_column(Session::get('cart'), 'course_id');
        return Course::whereIn('id', $coursesCart)->get();
    }
}
