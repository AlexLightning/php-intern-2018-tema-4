<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Festival extends Model {
    protected $guarded = [];
    public function fest(){
        return $this->belongsTo(Organizer::class,'org_id');
    }
}