<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAdsApplication extends Model
{
  public function user()
  {
      return $this->belongsTo(User::class,'user_id');
  }

  public function task()
  {
      return $this->belongsTo(Task::class,'task_id');
  }
}
