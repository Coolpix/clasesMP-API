<?php namespace App\Transformers\Zone;

use League\Fractal\TransformerAbstract;

class LessonsTransformer extends TransformerAbstract {

    public function transform($lesson){
        return [
            'id' => $lesson->id,
            'date' => $lesson->date,
            'students' => $lesson->students
        ];
    }
}