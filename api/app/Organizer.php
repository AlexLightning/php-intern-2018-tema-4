<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Organizer extends Model {
    protected $guarded = [];
    public function org(){
        return $this->hasMany(Festival::class);
    }
}