<?php

namespace App\Http\Controllers;

use App\Group;
use App\Transformers\Zone\GroupsTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;

class GroupsController extends Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAll(){
        $groups = Group::all();
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

    public function saveGroup(Request $request){
        $group = new Group;
        $group->name = $request->name;
        $group->date_start = $request->date_start;
        $group->date_end = $request->date_end;
        $group->saveOrFail();
        $group->zone()->associate($request->zone)->save();
        return (new GroupsTransformer)->transform($group);
    }

    public function updateGroup($id, Request $request){
        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->date_start = $request->date_start;
        $group->date_end = $request->date_end;
        $group->saveOrFail();
        $group->zone()->associate($request->zone)->save();
        return (new GroupsTransformer)->transform($group);
    }

    public function deleteGroup($id){
        $group = Group::findOrFail($id);
        $group->delete();
        return (new GroupsTransformer)->transform($group);
    }
}
