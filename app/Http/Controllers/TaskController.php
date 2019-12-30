<?php

namespace App\Http\Controllers;

use App\Task;
use App\Models\Skill;
use App\Models\SkillCat;
use App\User;
use Session;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
    
    public function showTaskList(Request $req)
    {
        $task = Task::where('user_id', backpack_user()->id)->orderBy('created_at')->get();
        return view('task_list', ['task' => $task]);

    }

    public function showTask(Request $req)
    {
        $task = Task::where('user_id', backpack_user()->id)->orderBy('created_at')->get();
        return view('task_list', ['task' => $task]);
    }

    public function showTaskRequest(Request $req){
        $skillcat = SkillCat::all();
        if($req->session()->get('task')!=null){
            $task = $req->session()->get('task');
            $skill = Skill::where('skill_cat_id', $req->session()->get('task')->skill_cat_id)->get();
            return view('task_request', ['task' => $task, 'skillcat' => $skillcat, 'skill' => $skill]);
        }else if($req->session()->get('draft')!=null){
            $draft = $req->session()->get('draft');
            return view('task_request', ['draft' => $draft, 'skillcat' => $skillcat]);
        }else{
            return view('task_request', []);
        }
    }

    public function showTaskRequestNew(Request $req){
        $draft = array(date("Ymd")."-".sprintf("%08d", backpack_user()->id)."-".rand(10000,99999), "Draft");
        Session::put(['task' => [], 'draft' => $draft]);
        return redirect(route('task.showrequest',[],false));
    }

    public function taskRequestGetSkill(Request $req){
        $skill = Skill::where('skill_cat_id', $req->inputskillcat)->get();
        $arr = [];
        foreach($skill as $s){
            array_push($arr, ['id'=>$s->id, 'name'=>$s->name]);
        }
        return $arr;
        // return $skill;
    }

    // public function getCompany(Request $req){   
    //     $comp = CompRegionConfig::where('region', $req->region)->get();  
    //     $arr = [];
    //     foreach($comp as $c){
    //         array_push($arr, ['id'=>$c->company_id, 'name'=>$c->companyid->company_descr]);
    //     }
    //     return $arr;
    // }
}
