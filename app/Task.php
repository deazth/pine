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

    public function parent()
    {
        return $this->belongsTo(Task::class,'parent_id');
    }

    public function child()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function interaction()
    {
        return $this->hasMany(TaskInteraction::class, 'task_id');
    public function applicant()
    {
        return $this->hasMany(TaskAdsApplication::class,'task_id');
    }

    public function iHaveApplied($user_id){
      $ap = $this->applicant->where('user_id', $user_id)->first();

      if($ap){
        return true;
      }

      return false;
    }
}
