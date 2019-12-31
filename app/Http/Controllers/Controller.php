<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];

    public function __construct(){
      $this->data['widgets']['before_content'] = [];
      $this->data['widgets']['after_content'] = [];

      $this->middleware(function ($request, $next) {
        $notiarr = [];
        $noticount = 0;
        $reqlist = \App\User::all();

        // 1. request assigned to me
        $reass = \App\Task::where('assign_id', backpack_user()->id)
          ->where('status', 'Proposed')->get();

        foreach($reass as $ous){
          array_push($notiarr, [
            'url' => route('task.viewrequest', ['inputid' => $ous->id]),
            'text' => $ous->user->name . ' proposed a task to you',
            'class' => 'fa fa-plus',
          ]);
          $noticount++;
        }

        // 2. staff want to cancel half way
        $reass = \App\Task::where('user_id', backpack_user()->id)
          ->where('status', 'Request to Cancel')->get();

        foreach($reass as $ous){
          array_push($notiarr, [
            'url' => route('task.viewrequest', ['inputid' => $ous->id]),
            'text' => $ous->assign->name . ' want to cancel task ' . $ous->name,
            'class' => 'fa fa-times',
          ]);
          $noticount++;
        }

        // 3. staff completed the task. pending verify
        $reass = \App\Task::where('user_id', backpack_user()->id)
          ->where('status', 'Pending Verification')->get();

        foreach($reass as $ous){
          array_push($notiarr, [
            'url' => route('task.viewrequest', ['inputid' => $ous->id]),
            'text' => $ous->assign->name . ' has completed task ' . $ous->name,
            'class' => 'fa fa-search',
          ]);
          $noticount++;
        }

        // 4. task completed. pending staff to rate requestor
        $reass = \App\Task::where('assign_id', backpack_user()->id)
          ->where('status', 'Completed')->whereNull('rating_user')->get();

        foreach($reass as $ous){
          array_push($notiarr, [
            'url' => route('task.viewrequest', ['inputid' => $ous->id]),
            'text' => $ous->assign->name . ' has completed task ' . $ous->name,
            'class' => 'fa fa-check',
          ]);
          $noticount++;
        }

        // 5. ads-ed task that someone applied to
        $reass = \App\Task::where('user_id', backpack_user()->id)
          ->where('status', 'Advertised')->get();

        foreach($reass as $ous){
          array_push($notiarr, [
            'url' => route('task.viewrequest', ['inputid' => $ous->id]),
            'text' => 'Someone applied for task ' . $ous->name,
            'class' => 'fa fa-heart',
          ]);
          $noticount++;
        }

        session()->flash('noti_count',$noticount);
        session()->flash('noti_list', $notiarr);


        return $next($request);
    });
    }


    protected function addAlert($type, $content = null, $header = null){
      $c = [
        'type' => 'alert',
        'class' => 'alert alert-' . $type . ' mb-2',
        'close_button' => true
      ];

      if(isset($content)){
        $c['content'] = $content;
      }

      if(isset($header)){
        $c['heading'] = $header;
      }

      array_push($this->data['widgets']['before_content'], $c);

    }

    protected function addVar($name, $value){
      $this->data[$name] = $value;
    }

    protected function addBeforeContent($widget){
      array_push($this->data['widgets']['before_content'], $widget);
    }

    protected function addAfterContent($widget){
      array_push($this->data['widgets']['after_content'], $widget);
    }
}
