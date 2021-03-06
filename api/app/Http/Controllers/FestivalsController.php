<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Festival;
class FestivalsController extends Controller
{
    public function __construct(){}
    public function showAllFestivals(){
        return json_encode(array('data' => Festival::all()));
    }
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'bands' => 'required',
            'tickets' => 'required'
        ]);
        $festival = Festival::create($request->all());
        return response()->json($festival);
    }
    public function updateShow($id){
        $toUpdate = Festival::find($id);
        return json_encode($toUpdate);
    }
    public function update($id, Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'bands' => 'required',
            'tickets' => 'required'
        ]);
        $toUpdate = Festival::find($id);
        $toUpdate->name = $request->name;
        $toUpdate->description = $request->description;
        $toUpdate->bands = $request->bands;
        $toUpdate->tickets = $request->tickets;
        $toUpdate->save();
        return response()->json($toUpdate);
    }
    public function delete($id){
        $toDelete = Festival::find($id);
        $toDelete->delete();
        return response("Delete done!");
    }
}