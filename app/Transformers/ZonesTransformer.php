<?php namespace App\Transformers\Zone;

use League\Fractal\TransformerAbstract;

class ZonesTransformer extends TransformerAbstract {

    public function transform($zone){
        return [
            'id' => $zone->id,
            'name' => $zone->name,
            'latitude' => $zone->latitude,
            'longitude' => $zone->longitude,
            'groups' => $zone->groups
        ];
    }
}