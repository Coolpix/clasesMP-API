<?php

namespace App\Http\Controllers;

use App\Group;
use App\Transformers\Zone\ZonesTransformer;
use App\Zone;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;

class ZonesController extends Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAll(){
        $zones = Zone::all();
        //Crear Transformer para arrays
        return $zones;
    }

    public function getById($id){
        $zone = Zone::findOrFail($id);
        return (new ZonesTransformer)->transform($zone);
    }

    public function getGroupsOfZone($id){
        $zone = Zone::findOrFail($id);
        return $zone->groups;
    }

    public function saveZone(Request $request){
        $zone = new Zone;
        $zone->name = $request->name;
        $zone->latitude = $request->latitude;
        $zone->longitude = $request->longitude;
        $zone->saveOrFail();
        foreach ($request->groups as $group){
            try {
                $groupToSave = Group::findOrFail($group);
                $zone->groups()->save($groupToSave);
            }catch (ModelNotFoundException $ex){
                return $this->response->errorNotFound('Zone '. $zone .' Not Found');
            }
        }
        return (new ZonesTransformer)->transform($zone);
    }

    public function updateZone($id, Request $request){
        $zone = Zone::findOrFail($id);
        $zone->name = $request->name;
        $zone->latitude = $request->latitude;
        $zone->longitude = $request->longitude;
        $zone->saveOrFail();
        foreach ($request->groups as $group){
            try {
                $groupToSave = Group::findOrFail($group);
                //Delete groups before save
                $zone->groups()->save($groupToSave);
            }catch (ModelNotFoundException $ex){
                return $this->response->errorNotFound('Zone '. $zone .' Not Found');
            }
        }
        return (new ZonesTransformer)->transform($zone);
    }

    public function deleteZone($id){
        $zone = Zone::findOrFail($id);
        $zone->delete();
        return (new ZonesTransformer)->transform($zone);
    }
}
