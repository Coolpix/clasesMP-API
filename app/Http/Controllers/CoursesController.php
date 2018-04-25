<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Transformers\Zone\CoursesTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class CoursesController extends Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAll(){
        $courses = Course::all();
        $manager = new Manager();
        $resource = new Collection($courses, new CoursesTransformer());
        $manager->createData($resource)->toArray();
        return $courses;
    }

    public function getById($id){
        $course = Course::findOrFail($id);
        return (new CoursesTransformer)->transform($course);
    }

    public function getZoneOfCourse($id){
        $courses = Course::findOrFail($id);
        return $courses->zone;
    }

    public function getLessonsOfCourse($id){
        $course = Course::findOrFail($id);
        return $course->lessons;
    }

    public function getStudentsOfCourse($id){
        $course = Course::findOrFail($id);
        return $course->students;
    }

    public function saveCourse(Request $request){
        $course = new Course;
        $course->name = $request->name;
        $course->date_start = $request->date_start;
        $course->date_end = $request->date_end;
        $course->time_start = $request->time_start;
        $course->time_end = $request->time_end;
        $course->saveOrFail();
        $course->zone()->associate($request->zone)->save();
        $course->students()->attach($request->students);
        foreach ($request->lessons as $lesson){
            $lessonToSave = new Lesson;
            $lessonToSave->date = $lesson['date'];
            $lessonToSave->saveOrFail();
            $lessonToSave->students()->attach($lesson['students']);
            $course->lessons()->save($lessonToSave);
        }
        return (new CoursesTransformer)->transform($course);
    }

    public function updateCourse($id, Request $request){
        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->date_start = $request->date_start;
        $course->date_end = $request->date_end;
        $course->time_start = $request->time_start;
        $course->time_end = $request->time_end;
        $course->saveOrFail();
        $course->zone()->associate($request->zone)->save();
        $course->students()->detach();
        $course->students()->attach($request->students);
        foreach ($request->lessons as $lesson){
            $lessonToSave = new Lesson;
            $lessonToSave->date = $lesson['date'];
            $lessonToSave->saveOrFail();
            $lessonToSave->students()->attach($lesson['students']);
            $course->lessons()->save($lessonToSave);
        }
        return (new CoursesTransformer)->transform($course);
    }

    public function deleteCourse($id){
        $course = Course::findOrFail($id);
        $course->delete();
        return (new CoursesTransformer)->transform($course);
    }
}
