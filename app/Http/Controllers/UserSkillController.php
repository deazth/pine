<?php

namespace App\Http\Controllers;

use App\UserSkill;
use App\Models\SkillCat;
use App\Models\Skill;

use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_id = backpack_user()->id;

      $us = UserSkill::where('user_id',$user_id)->get();
          return view('userSkill.index', ['userSkills' => $us]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skillcat = SkillCat::all();

        return view('userSkill.create', ['skillcat' => $skillcat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $inputskill = $req->inputskill;
        $user_id = backpack_user()->id;
        $check = UserSkill::where('user_id', $user_id)->where('skill_id',$inputskill)->count();



    if($check == 0){
    $userSkill = new UserSkill;
    $userSkill->user_id = $user_id;
    $userSkill->skill_id = $inputskill;
    $userSkill->updated_by = $user_id;
    $userSkill->save();

    $a_text = 'Successfully add skill';
    $a_type = "success";
}
else{
    $a_text = 'The skill already existed';
    $a_type = "warning";

    }
    return redirect(route('userskill.index', [], false))
    ->with(['a_text' => $a_text,'a_type' => $a_type]);
  }



    /**
     * Display the specified resource.
     *
     * @param  \App\UserSkill  $userSkill
     * @return \Illuminate\Http\Response
     */
    public function show(UserSkill $userSkill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserSkill  $userSkill
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSkill $userSkill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserSkill  $userSkill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSkill $userSkill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserSkill  $userSkill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {


      $us = UserSkill::find($req->usid);
      if($us){        $us->delete();

        return redirect(route('userskill.index', [], false))->with([]);
      } else {
        return redirect(route('userskill.index', [], false))->with([]);
      }
    }

    public function find(Request $req){
      $skillcat = SkillCat::all();

      if($req->filled('inputskill')){

        $theskill = Skill::find($req->inputskill);

        $uslist = UserSkill::where('skill_id', $req->inputskill)->get();

        return view('userSkill.searchuser', ['skillcat' => $skillcat, 'sresult' => $uslist
          , 'skillname' => $theskill->name
        ]);
      }

      return view('userSkill.searchuser', ['skillcat' => $skillcat]);

    }
}
