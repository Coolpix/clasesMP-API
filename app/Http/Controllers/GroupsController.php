<?php

namespace App\Http\Controllers;

use App\Group;
use App\Lesson;
use App\Transformers\Zone\GroupsTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class GroupsController extends Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAll(){
        $groups = Group::all();
        $manager = new Manager();
        $resource = new Collection($groups, new GroupsTransformer());
        $manager->createData($resource)->toArray();
        return $groups;
    }

    public function getById($id){
        $group = Group::findOrFail($id);
        return (new GroupsTransformer)->transform($group);
    }

    public function getZoneOfGroup($id){
        $group = Group::findOrFail($id);
        return $group->zone;
    }

    public function getLessonsOfGroup($id){
        $group = Group::findOrFail($id);
        return $group->lessons;
    }

    public function getStudentsOfGroup($id){
        $group = Group::findOrFail($id);
        return $group->students;
    }

    public function saveGroup(Request $request){
        $group = new Group;
        $group->name = $request->name;
        $group->date_start = $request->date_start;
        $group->date_end = $request->date_end;
        $group->time_start = $request->time_start;
        $group->time_end = $request->time_end;
        $group->saveOrFail();
        $group->zone()->associate($request->zone)->save();
        $group->students()->attach($request->students);
        foreach ($request->lessons as $lesson){
            $lessonToSave = new Lesson;
            $lessonToSave->date = $lesson['date'];
            $lessonToSave->saveOrFail();
            $lessonToSave->students()->attach($lesson['students']);
            $group->lessons()->save($lessonToSave);
        }
        return (new GroupsTransformer)->transform($group);
    }

    public function updateGroup($id, Request $request){
        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->date_start = $request->date_start;
        $group->date_end = $request->date_end;
        $group->time_start = $request->time_start;
        $group->time_end = $request->time_end;
        $group->saveOrFail();
        $group->zone()->associate($request->zone)->save();
        $group->students()->detach();
        $group->students()->attach($request->students);
        foreach ($request->lessons as $lesson){
            $lessonToSave = new Lesson;
            $lessonToSave->date = $lesson['date'];
            $lessonToSave->saveOrFail();
            $lessonToSave->students()->attach($lesson['students']);
            $group->lessons()->save($lessonToSave);
        }
        return (new GroupsTransformer)->transform($group);
    }

    public function deleteGroup($id){
        $group = Group::findOrFail($id);
        $group->delete();
        return (new GroupsTransformer)->transform($group);
    }
}
