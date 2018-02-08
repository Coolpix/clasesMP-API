<?php namespace App\Transformers\Zone;

use League\Fractal\TransformerAbstract;

class GroupsTransformer extends TransformerAbstract {

    public function transform($group){
        return [
            'id' => $group->id,
            'date_start' => $group->date_start,
            'date_end' => $group->date_end,
            'zone' => $group->zone,
            'lessons' => $group->lessons,
            'students' => $group->students
        ];
    }
}