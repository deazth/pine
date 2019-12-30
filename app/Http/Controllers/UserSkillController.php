<?php

namespace App\Http\Controllers;

use App\UserSkill;
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
      $us = UserSkill::all();
          return view('userskill.index', ['userSkills' => $us]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(UserSkill $userSkill)
    {
        //
    }
}
