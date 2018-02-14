<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformers\Zone\LessonsTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class LessonsController extends Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAll(){
        $lessons = Lesson::all();
        $manager = new Manager();
        $resource = new Collection($lessons, new LessonsTransformer());
        $manager->createData($resource)->toArray();
        return $lessons;
    }

    public function getById($id){
        $lesson = Lesson::findOrFail($id);
        return (new LessonsTransformer)->transform($lesson);
    }

    public function getGroupOfLesson($id) {
        $lesson = Lesson::findOrFail($id);
        return $lesson->group;
    }

    public function getStudentsOfLesson($id) {
        $lesson = Lesson::findOrFail($id);
        return $lesson->students;
    }

    public function saveLesson(Request $request){
        $lesson = new Lesson;
        $lesson->date = $request->date;
        $lesson->saveOrFail();
        $lesson->students()->attach($request->students);
        return (new LessonsTransformer)->transform($lesson);
    }

    public function updateLesson($id, Request $request){
        $lesson = Lesson::findOrFail($id);
        $lesson->date = $request->date;
        $lesson->saveOrFail();
        $lesson->students()->detach();
        $lesson->students()->attach($request->students);
        return (new LessonsTransformer)->transform($lesson);
    }

    public function deleteLesson($id){
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return (new LessonsTransformer)->transform($lesson);
    }
}
