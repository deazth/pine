<?php

namespace App;
use App\Models\SkillCat;
use App\Models\Skill;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }


}
