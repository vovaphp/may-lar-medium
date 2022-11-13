<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    protected $fillable = ['name'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * add to array Tasks info about task owner
     * @param $tasks
     * @return array
     */
    protected static function checkOwnerAuthorise($tasks){
        foreach ($tasks as $key => $value){
          if($tasks[$key]['user_id']==Auth::user()->id){
                $tasks[$key]['OwnerAuthorise']=true;
            }else{
                $tasks[$key]['OwnerAuthorise']=false;
            }
        }
        return $tasks;
    }
}
