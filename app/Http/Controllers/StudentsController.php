<?php

namespace App\Http\Controllers;

use App\Student;
use App\Transformers\Zone\StudentsTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class StudentsController extends Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAll(){
        $student = Student::all();
        $manager = new Manager();
        $resource = new Collection($student, new StudentsTransformer());
        $manager->createData($resource)->toArray();
        return $student;
    }

    public function getById($id){
        $student = Student::findOrFail($id);
        return (new StudentsTransformer)->transform($student);
    }

    public function getGroups($id){
        $student = Student::findOrFail($id);
        return $student->groups;
    }

    public function getLessons($id){
        $student = Student::findOrFail($id);
        return $student->lessons;
    }

    public function saveStudent(Request $request){
        $student = new Student;
        $student->name = $request->name;
        $student->phone_number = $request->phone_number;
        $student->gender = $request->gender;
        $student->saveOrFail();
        $student->groups()->attach($request->groups);
        $student->lessons()->attach($request->lessons);
        return (new StudentsTransformer)->transform($student);
    }

    public function updateStudent($id, Request $request){
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->phone_number = $request->phone_number;
        $student->gender = $request->gender;
        $student->saveOrFail();
        $student->groups()->detach();
        $student->groups()->attach($request->groups);
        $student->lessons()->detach();
        $student->lessons()->attach($request->lessons);
        return $student;
    }

    public function deleteStudent($id){
        $student = Student::findOrFail($id);
        $student->delete();
        return $student;
    }
}
