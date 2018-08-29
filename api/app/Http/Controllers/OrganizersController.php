<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Organizer;
class OrganizersController extends Controller
{
    public function __construct(){}
    public function showAllOrganizers(){
        return json_encode(array('data' => Organizer::all()));
    }
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $organizer = Organizer::create($request->all());
        return response()->json($organizer);
    }
    public function updateShow($id){
        $toUpdate = Organizer::find($id);
        return json_encode($toUpdate);
    }
    public function update($id, Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $toUpdate = Organizer::find($id);
        $toUpdate->name = $request->name;
        $toUpdate->description = $request->description;
        $toUpdate->save();
        return response()->json($toUpdate);
    }
    public function delete($id){
        $toDelete = Organizer::find($id);
        $toDelete->delete();
        return response("Delete done!");
    }
}