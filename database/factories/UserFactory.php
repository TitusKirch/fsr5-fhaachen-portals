<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state. Expects that the courses table is already pre-populated.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'firstname' => $this->faker->firstName(),
          'lastname' => $this->faker->lastName(),
          'email' => $this->faker->email(),
          'course_id' => Course::all(['id'])->random(),
          'is_tutor' => $this->faker->boolean(10),
          'is_admin' => $this->faker->boolean(2)
        ];
    }

  /**
   * Create users with tutor and/or admin privileges
   *
   * @param Boolean $is_tutor
   * @param Boolean $is_admin
   *
   * @return Factory
   */
    public function elevatedPrivileges($is_tutor, $is_admin)
    {
        return $this->state(function (array $attributes) use ($is_tutor, $is_admin) {
            return [
              'is_tutor' => $is_tutor,
              'is_admin' => $is_admin
            ];
        });
    }
}
