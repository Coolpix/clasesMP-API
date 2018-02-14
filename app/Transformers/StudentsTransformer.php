<?php namespace App\Transformers\Zone;

use League\Fractal\TransformerAbstract;

class StudentsTransformer extends TransformerAbstract {

    public function transform($student){
        return [
            'id' => $student->id,
            'name' => $student->name,
            'phone_number' => $student->phone_number,
            'gender' => $student->gender,
            'email' => $student->email,
            'groups' => $student->groups,
            'lessons' => $student->lessons
        ];
    }
}