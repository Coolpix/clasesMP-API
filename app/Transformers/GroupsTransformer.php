<?php namespace App\Transformers\Zone;

use App\Group;
use League\Fractal\TransformerAbstract;

class GroupsTransformer extends TransformerAbstract {

    public function transform(Group $group){
        return [
            'id' => $group->id,
            'name' => $group->name,
            'date_start' => $group->date_start,
            'date_end' => $group->date_end,
            'time_start' => $group->time_start,
            'time_end' => $group->time_end,
            'zone' => $group->zone,
            'lessons' => $group->lessons,
            'students' => $group->students
        ];
    }
}