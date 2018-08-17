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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'bands' => 'required',
            'tickets' => 'required',
            'org' => 'required'
        ]);
        $festival = Festival::create($request->all());
        return response()->json($festival);
    }
    public function update($id, Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'bands' => 'required',
            'tickets' => 'required',
            'org' => 'required'
        ]);
        $toUpdate = Festival::find($id);
        $toUpdate->name = $request->name;
        $toUpdate->description = $request->description;
        $toUpdate->bands = $request->bands;
        $toUpdate->tickets = $request->tickets;
        $toUpdate->org = $request->org;
        $toUpdate->save();
        return response()->json($toUpdate);
    }
    public function delete($id){
        $toDelete = Festival::find($id);
        $toDelete->delete();
        return response("Delete done!");
    }
}