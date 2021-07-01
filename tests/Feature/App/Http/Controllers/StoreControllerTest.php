<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function test_client_can_see_all_store_courses()
    {
        // Prepare
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->get(route('store'));

        // Assert
        $response->assertViewHas('courses');
    }

    public function test_client_can_not_have_course()
    {
        // Prepare
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->get(route('get-course', $course->id));

        // Assert
        $response->assertViewIs('campus.courses.buy');
    }

    public function test_admin_can_have_course()
    {
        // Prepare
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $user->courses()->attach(['course_id' => $course->id]);
        $this->actingAs($user);

        // Act
        $response = $this->get(route('get-course', $course->id));

        // Assert
        $response->assertViewIs('campus.courses.course');
    }


}
