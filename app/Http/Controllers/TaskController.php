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
        $assignee = User::all();
        if($req->session()->get('task')!=null){
            $task = $req->session()->get('task');
            $skill = Skill::where('skill_cat_id', $req->session()->get('task')->skill_cat_id)->get();
            return view('task_request', ['assignee' => $assignee, 'task' => $task, 'skillcat' => $skillcat, 'skill' => $skill]);
        }else if($req->session()->get('draft')!=null){
            $draft = $req->session()->get('draft');
            return view('task_request', ['assignee' => $assignee, 'draft' => $draft, 'skillcat' => $skillcat]);
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
    }

    public function submitTaskRequest(Request $req){
        // if($req->inputtype=="advert"){
        if($req->inputid==null){
            $new = new Task;
        }else{
            $new = Task::find($req->inputid);
        }
        // dd($req->session()->get('draft'));
        $new->reference_no = $req->session()->get('draft')[0];
        $new->name = $req->inputname;
        $new->descr = $req->inputdescription;
        $new->user_id = backpack_user()->id;
        $new->skill_id = $req->inputskill;
        $new->skill_cat_id = $req->inputskillcat;
        if($req->inputassignid!=null){
            $new->assign_id = $req->inputassignid;
            $new->status = "Proposed";
            $new->save();
            return redirect(route('task.showlist',[],false))->with([
                'feedback' => true,
                'feedback_text' => "Successfully assigned new task request!",
                'feedback_type' => "success"
            ]);
        }else{
            $new->status = "Advertised";
            $new->save();
            return redirect(route('task.showlist',[],false))->with([
                'feedback' => true,
                'feedback_text' => "Successfully advertised new task request!",
                'feedback_type' => "success"
            ]);
        }
    }

    
}
