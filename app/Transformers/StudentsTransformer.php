<?php namespace App\Transformers\Zone;

use League\Fractal\TransformerAbstract;

class StudentsTransformer extends TransformerAbstract {

    public function transform($zone){
        return [
            'id' => $zone->id,
            'name' => $zone->name,
            'phone_number' => $zone->phone_number,
            'gender' => $zone->gender,
            'groups' => $zone->groups
        ];
    }
}