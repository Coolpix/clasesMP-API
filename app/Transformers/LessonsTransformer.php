<?php namespace App\Transformers\Zone;

use League\Fractal\TransformerAbstract;

class LessonsTransformer extends TransformerAbstract {

    public function transform($lesson){
        return [
            'id' => $lesson->id,
            'date' => $lesson->date,
            'group' => $lesson->group,
            'students' => $lesson->students
        ];
    }
}