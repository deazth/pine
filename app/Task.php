<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;
use App\TaskAdsApplication;

class Task extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function assign()
    {
        return $this->belongsTo(User::class,'assign_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class,'skill_id');
    }

    public function iHaveApplied($user_id){
      $ap = TaskAdsApplication::where('task_id', $this->id)
        ->where('user_id', $user_id)->first();

      if($ap){
        return true;
      }

      return false;
    }
}
