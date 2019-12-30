<?php

namespace App\Http\Controllers;

use App\Task;
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
        if($req->session()->get('task')!=null){
            $task = $req->session()->get('task');
            return view('task_request', ['task' => $task]);
        }else{
            return view('task_request', []);
        }
    }

    public function showTaskRequestNew(Request $req){
        Session::put(['task' => []]);
        return redirect(route('task.showrequest',[],false));
    }
}
