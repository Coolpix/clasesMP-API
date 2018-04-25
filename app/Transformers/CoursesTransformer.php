<?php namespace App\Transformers\Zone;

use App\Course;
use League\Fractal\TransformerAbstract;

class CoursesTransformer extends TransformerAbstract {

    public function transform(Course $course){
        return [
            'id' => $course->id,
            'name' => $course->name,
            'date_start' => $course->date_start,
            'date_end' => $course->date_end,
            'time_start' => $course->time_start,
            'time_end' => $course->time_end,
            'zone' => $course->zone,
            'lessons' => $course->lessons,
            'students' => $course->students
        ];
    }
}