<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskInteraction;
use App\TaskHistory;
use App\Models\Skill;
use App\Models\SkillCat;
use App\User;
use App\TaskAdsApplication;
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

    public function showTaskPending(Request $req)
    {
        $assign = Task::where('assign_id', backpack_user()->id)->orderBy('created_at')->get();
        return view('task_pending', ['assign' => $assign]);
    }

    public function showTask(Request $req)
    {
        $task = Task::where('user_id', backpack_user()->id)->orderBy('created_at')->get();
        return view('task_list', ['task' => $task]);
    }

    public function showTaskOpen(Request $req)
    {
        $task = Task::where('status', 'Advertised')
          ->where('user_id', '!=', backpack_user()->id)
          ->orderBy('created_at')->get();
        return view('task_advert', ['task' => $task]);
    }

    public function showTaskRequest(Request $req)
    {
        $skillcat = SkillCat::all();
        $assignee = User::all();
        // dd($req);
        if ($req->session()->get('task')!=null) {
            $taskm = TaskInteraction::where('user_id','!=',backpack_user()->id)->where('id', $req->session()->get('task')[0])->get();
            foreach($taskm as $s){
                $s->read = X;
                $s->save();
            }
            $task = Task::where('id', $req->session()->get('task')[0])->first();
            $skill = Skill::where('skill_cat_id', $req->session()->get('task')[1])->get();

            // foreach($task->applicant as $aaaa){
            //   dd($aaaa->user);
            // }

            return view('task_request', ['assignee' => $assignee, 'task' => $task, 'skillcat' => $skillcat, 'skill' => $skill, 'user' => backpack_user()->id]);
        } elseif ($req->session()->get('draft')!=null) {
            $draft = $req->session()->get('draft');
            return view('task_request', ['assignee' => $assignee, 'draft' => $draft, 'skillcat' => $skillcat, 'user' => backpack_user()->id]);
        } else {
            return redirect(route('task.showlist', [], false));
        }
    }

    public function showTaskRequestNew(Request $req)
    {
        $draft = array(date("Ymd")."-".sprintf("%08d", backpack_user()->id)."-".rand(10000, 99999), "Draft", backpack_user()->staff_no, backpack_user()->name, $req->session()->get('parentid'), $req->session()->get('parentrefno'), $req->session()->get('parentname'), $req->session()->get('parentdate'));
        Session::put(['task' => [], 'draft' => $draft]);
        return redirect(route('task.showrequest', [], false));
    }

    public function viewTaskRequest(Request $req)
    {
        $taskid = Task::where('id', $req->inputid)->first();
        $task = array($taskid->id, $taskid->skill_cat_id);
        Session::put(['task' => $task, 'draft' => []]);
        // dd($req);
        return redirect(route('task.showrequest', [], false));
    }

    public function taskRequestGetSkill(Request $req)
    {
        $skill = Skill::where('skill_cat_id', $req->inputskillcat)->get();
        $arr = [];
        foreach ($skill as $s) {
            array_push($arr, ['id'=>$s->id, 'name'=>$s->name]);
        }
        return $arr;
    }

    public function submitMessage(Request $req)
    {
        $task = new TaskInteraction;
        $task->user_id = backpack_user()->id;
        $task->task_id = $req->inputid;
        $task->message = $req->inputmessage;
        $task->save();
        $task = Task::find($req->inputid);
        $task = array($task->id, $task->skill_cat_id);
        Session::put(['task' => $task, 'draft' => []]);
        return redirect()->back();
        // return redirect(route('task.showrequest',[], false));
    }

    public function proposeReject(Request $req)
    {
        $task = Task::find($req->task_id);

        $euser = User::find($task->assign_id);
        $euser->task_reject = $euser->task_reject + 1;
        $euser->save();

        $task->status = "Open";
        $task->assign_id = null;
        $task->save();
        return redirect(route('task.showpending', [], false))->with([
            'feedback' => true,
            'feedback_text' => "Successfully declined new task request!",
            'feedback_type' => "warning"
        ]);
    }

    public function proposeAccept(Request $req)
    {
        $task = Task::find($req->task_id);
        $task->status = "In Progress";
        $task->save();

        $euser = User::find($task->assign_id);
        $euser->task_accept = $euser->task_accept + 1;
        $euser->save();

        $task = array($task->id, $task->skill_cat_id);
        Session::put(['task' => $task, 'draft' => []]);
        $newl = new TaskHistory;
        $newl->task_id = $req->task_id;
        $newl->user_id = backpack_user()->id;
        $assid = User::find(backpack_user()->id);
        $newl->description = $assid->staff_no."-".$assid->name."has accepted task";
        $newl->save();

        return redirect(route('task.showrequest', [], false))->with([
            'feedback' => true,
            'feedback_text' => "Successfully accepted new task request!",
            'feedback_type' => "success"
        ]);
    }

    public function cancellationReject(Request $req)
    {
        $task = Task::find($req->task_id);
        $task->status = "In Progress";
        $task->save();

        return redirect(route('task.showlist', [], false))->with([
            'feedback' => true,
            'feedback_text' => "Successfully rejected task cancellation request!",
            'feedback_type' => "warning"
        ]);
    }

    public function cancellationApprove(Request $req)
    {
        $task = Task::find($req->task_id);

        $euser = User::find($task->assign_id);
        $euser->task_cancel = $euser->task_cancel + 1;
        $euser->save();

        $task->status = "Open";
        $task->assign_id = null;
        $task->save();
        $task = array($task->id, $task->skill_cat_id);
        Session::put(['task' => $task, 'draft' => []]);
        return redirect(route('task.showrequest', [], false))->with([
            'feedback' => true,
            'feedback_text' => "Successfully approved task cancellation request!",
            'feedback_type' => "success"
        ]);
    }


    public function submitTaskRequest(Request $req)
    {
        if ($req->inputid==null) {
            $new = new Task;
            $new->reference_no = $req->session()->get('draft')[0];
            $new->user_id = backpack_user()->id;

            $euser = User::find(backpack_user()->id);
            $euser->task_create = $euser->task_create + 1;
            $euser->save();

        }else{
            $new = Task::find($req->inputid);
            $new->reference_no = $req->inputref;
        }
        if ($req->inputparentid!=null) {
            $new->parent_id = $req->inputparentid;
        }

        $new->name = $req->inputname;
        $new->descr = $req->inputdescription;
        $new->skill_id = $req->inputskill;
        $new->skill_cat_id = $req->inputskillcat;
        if ($req->inputassignid!=null) {
            $new->assign_id = $req->inputassignid;
            $new->status = "Proposed";
            $new->save();
            $newl = new TaskHistory;
            if ($req->inputid==null) {
                $newl->task_id = $new->id;
            }else{
                $newl->task_id = $req->$inputid;
            }
            $newl->user_id = backpack_user()->id;
            $newl->description = "Created new task request";
            $newl->save();
            $newl = new TaskHistory;
            if ($req->inputid==null) {
                $newl->task_id = $new->id;
            }else{
                $newl->task_id = $req->$inputid;
            }
            $newl->user_id = backpack_user()->id;
            $assid = User::find($req->inputassignid);
            $newl->description = "Assigned task to ".$assid->staff_no."-".$assid->name;
            $newl->save();
            return redirect(route('task.showlist', [], false))->with([
                'feedback' => true,
                'feedback_text' => "Successfully assigned new task request!",
                'feedback_type' => "success"
            ]);
        } else {
            $new->status = "Advertised";
            $new->assign_id = null;
            $new->save();
            $newl = new TaskHistory;
            if ($req->inputid==null) {
                $newl->task_id = $new->id;
            }else{
                $newl->task_id = $req->$inputid;
            }
            $newl->user_id = backpack_user()->id;
            $newl->description = "Created new task request";
            $newl->save();
            $newl = new TaskHistory;
            if ($req->inputid==null) {
                $newl->task_id = $new->id;
            }else{
                $newl->task_id = $req->$inputid;
            }
            $newl->user_id = backpack_user()->id;
            $newl->description = "Advertised task";
            $newl->save();
            return redirect(route('task.showlist', [], false))->with([
                'feedback' => true,
                'feedback_text' => "Successfully advertised new task request!",
                'feedback_type' => "success"
            ]);
        }
    }

    public function assigneeComplete(Request $req)
    {
        $task = Task::find($req->task_id);
        $task->status = 'Pending Verification';
        $task->save();
        $newl = new TaskHistory;
        $newl->task_id = $req->task_id;
        $newl->user_id = backpack_user()->id;
        $newl->description = "Assignee request to verify completion";
        $newl->save();


        return redirect(route('task.showpending', [], false))->with([
        'feedback' => true,
        'feedback_text' => "Successfully submit the task for verification!",
        'feedback_type' => "success"
    ]);
    }


    public function applyForAds(Request $req)
    {
        $dattask = Task::find($req->inputid);

        if ($dattask) {
            if ($dattask->iHaveApplied(backpack_user()->id)) {
                return redirect()->back()->with([
              'feedback' => true,
              'feedback_text' => "You have already applied for this Ads",
              'feedback_type' => "warning"
          ]);
            }


            $nuapply = new TaskAdsApplication;
            $nuapply->user_id = backpack_user()->id;
            $nuapply->task_id = $dattask->id;
            $nuapply->save();

            return redirect()->back()->with([
            'feedback' => true,
            'feedback_text' => "Application submitted to requestor",
            'feedback_type' => "success"
        ]);
        } else {
            return redirect()->back()->with([
            'feedback' => true,
            'feedback_text' => "Selected Advertisement no longer available",
            'feedback_type' => "warning"
        ]);
        }
    }



    public function assigneeCancel(Request $req)
    {
        $task = Task::find($req->task_id);
        $task->status = 'Request to Cancel';
        $task->save();



        return redirect(route('task.showpending', [], false))->with([
            'feedback' => true,
            'feedback_text' => "The task has been cancelled and redirected to requester!!",
            'feedback_type' => "success"
        ]);
    }
    public function assigneeExtend(Request $req)
    {
        $task = Task::find($req->task_id);
        return redirect(route('task.newrequest', [], false))->with([
            'feedback' => true,
            'feedback_text' => "The task has been cancelled and redirected to requester!!",
            'feedback_type' => "success",
            'parentid' => $req->task_id,
            'parentrefno' => $task->reference_no,
            'parentname' => $task->name,
            'parentdate' => $task->created_at
        ]);
    }




    public function requesterVerify(Request $req)
    {
        $task = Task::find($req->task_id);
        $task->status = 'Request to Cancel';
        $task->save();

        return redirect(route('task.showpending', [], false))->with([
              'feedback' => true,
              'feedback_text' => "The task has been cancelled and redirected to requestor!!",
              'feedback_type' => "danger"
          ]);
    }


    public function requesterReject(Request $req)
    {
        $task = Task::find($req->task_id);
        $task->status = 'In Progress';
        $task->save();



        return redirect(route('task.showlist', [], false))->with([
                'feedback' => true,
                'feedback_text' => "The task has been marked incomplete and resend to assignee",
                'feedback_type' => "warning"
            ]);
    }


    public function requesterRate(Request $req)
    {
        $task = Task::find($req->id);
        $task->status = 'Completed';
        $euser = User::find($task->assign_id);
        $euser->task_complete = $euser->task_complete + 1;
        $euser->total_do_count = $euser->total_do_count + 1;
        $euser->total_do_rating = $euser->total_do_rating + $req->rating_assign;
        $euser->save();
        $task->rating_assign = $req->rating_assign;

        $task->success_rating_assign = $req->success_rating_assign;

        $task->save();



        return redirect(route('task.showlist', [], false))->with([
                  'feedback' => true,
                  'feedback_text' => "The task has been completed",
                  'feedback_type' => "info"
              ]);
    }


    public function assigneeRate(Request $req)
    {
        $task = Task::find($req->id);
      //  $task->status = 'Completed';
        $task->rating_user = $req->rating_user;

        $euser = User::find($task->user_id);
        $euser->task_complete = $euser->task_complete + 1;
        $euser->total_req_count = $euser->total_req_count + 1;
        $euser->total_req_rating = $euser->total_req_rating + $req->rating_user;
        $euser->save();

        $task->success_rating_user = $req->success_rating_user;

        $task->save();

        $newl = new TaskHistory;
        $newl->task_id = $req->id;
        $newl->user_id = backpack_user()->id;
        $newl->description = "Task has been completed";
        $newl->save();

        return redirect(route('task.showlist', [], false))->with([
                  'feedback' => true,
                  'feedback_text' => "Thank you for submitting the rating",
                  'feedback_type' => "info"
              ]);
    }
}
