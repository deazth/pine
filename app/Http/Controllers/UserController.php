<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Charts\CartaGeraf;
use \Calendar;
use App\User;
use App\Task;

class UserController extends Controller
{

  protected $baseuri = "https://api.oip.tm.com.my/app/t/tmrnd.com.my/era/1.0.0/profile/";
  protected $options = [
    'query' => ['api_key' => 'Z9HYE86CIElVjTEJuDOy2eBWPrL96et41wUmjL3M'],
    'headers' => ['Authorization' => 'Bearer 5a107934-68de-38cd-9a34-60fa4ae46267']
  ];

  protected $borderColors = [
          "rgba(255, 99, 132, 1.0)",
          "rgba(22,160,133, 1.0)",
          "rgba(255, 205, 86, 1.0)",
          "rgba(51,105,232, 1.0)",
          "rgba(244,67,54, 1.0)",
          "rgba(34,198,246, 1.0)",
          "rgba(153, 102, 255, 1.0)",
          "rgba(255, 159, 64, 1.0)",
          "rgba(233,30,99, 1.0)",
          "rgba(205,220,57, 1.0)"
      ];
  protected $fillColors = [
        "rgba(255, 99, 132, 0.2)",
        "rgba(22,160,133, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(51,105,232, 0.2)",
        "rgba(244,67,54, 0.2)",
        "rgba(34,198,246, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(233,30,99, 0.2)",
        "rgba(205,220,57, 0.2)"

    ];

  public function showProfile(Request $req){

    if($req->filled('staff_no')){
      $staffno = $req->staff_no;
    } else {
      // dd('own');
      // dd(backpack_user()->staff_no);
      $staffno = backpack_user()->staff_no;
    }

    $this->addVar('staff_no', $staffno);

    // get lifetime stats
    $cuser = User::where('staff_no', $staffno)->first();
    if($cuser){

      if($cuser->total_req_count > 0){
        $avrate = $cuser->total_req_rating / $cuser->total_req_count;
        $r5 = Task::where('user_id', $cuser->id)->where('status', 'Complete')->where('rating_user', 5)->count();
        $r4 = Task::where('user_id', $cuser->id)->where('status', 'Complete')->where('rating_user', 4)->count();
        $r3 = Task::where('user_id', $cuser->id)->where('status', 'Complete')->where('rating_user', 3)->count();
        $r2 = Task::where('user_id', $cuser->id)->where('status', 'Complete')->where('rating_user', 2)->count();
        $r1 = Task::where('user_id', $cuser->id)->where('status', 'Complete')->where('rating_user', 1)->count();

        $usersChart = new CartaGeraf;
        $usersChart->labels(['5', '4', '3', '2', '1']);
        $usersChart->title('Requestor Rating: ' . $avrate);
        $usersChart->dataset('Ratings by Requestee', 'horizontalBar', [$r5, $r4, $r3, $r2, $r1])
          ->color($this->borderColors)
          ->backgroundcolor($this->fillColors)
          ->options([
            'tooltips' => ['mode' => 'index', 'intersect' => true],
            'hover' => ['mode' => 'nearest', 'intersect' => true]
          ]);

        $this->addVar('chart1', $usersChart);
      }

      if($cuser->total_do_count > 0){
        $avrate = $cuser->total_do_rating / $cuser->total_do_count;
        $r5 = Task::where('assign_id', $cuser->id)->where('status', 'Complete')->where('rating_assign', 5)->count();
        $r4 = Task::where('assign_id', $cuser->id)->where('status', 'Complete')->where('rating_assign', 4)->count();
        $r3 = Task::where('assign_id', $cuser->id)->where('status', 'Complete')->where('rating_assign', 3)->count();
        $r2 = Task::where('assign_id', $cuser->id)->where('status', 'Complete')->where('rating_assign', 2)->count();
        $r1 = Task::where('assign_id', $cuser->id)->where('status', 'Complete')->where('rating_assign', 1)->count();

        $usersChart = new CartaGeraf;
        $usersChart->labels(['5', '4', '3', '2', '1']);
        $usersChart->title('Requestee Rating: ' . $avrate);
        $usersChart->dataset('Ratings by Requestor', 'horizontalBar', [$r5, $r4, $r3, $r2, $r1])
          ->color($this->borderColors)
          ->backgroundcolor($this->fillColors);

        $this->addVar('chart2', $usersChart);
      }

      $cc2 = new CartaGeraf;
      $cc2->labels(['Created', 'Accepted', 'Completed', 'Rejected', 'Cancelled']);
      $cc2->dataset('Task Count', 'bar', [
        $cuser->task_create,
        $cuser->task_accept,
        $cuser->task_complete,
        $cuser->task_reject,
        $cuser->task_cancel
      ])
        ->color($this->borderColors)
        ->backgroundcolor($this->fillColors);
      $cc2->options([
          'responsive' => true,
          'tooltips' => ['mode' => 'point', 'intersect' => true],
          'hover' => ['mode' => 'nearest', 'intersect' => true],
        ]);

      // dd($cc2);


      $this->addVar('chart3', $cc2);


    }



    $this->addVar('info', $this->getEraProfile($staffno));

    // dd($this->data);

    return view('user_profile', $this->data);

  }

  public function getStaffImage(Request $req){
    if($req->filled('staff_no')){
      $staffno = $req->staff_no;
    } else {
      $staffno = backpack_user()->staff_no;
    }

    return $this->getEraImage($staffno);
  }

  private function getEraProfile($staff_no){
    $reclient = new Client(["base_uri" => $this->baseuri]);
    // get profile from api


    // dd($options);

    $request = $reclient->request('GET', 'info/' . $staff_no, $this->options)->getBody()->getContents();
    // $request->addHeader('Authorization: Bearer', '5a107934-68de-38cd-9a34-60fa4ae46267');
    // $resp = $reclient->send($request);

    $ret = json_decode($request);
    if(sizeof($ret) > 0){
      return $ret[0];
    } else {
      return null;
    }

  }

  private function getEraImage($staff_no){
    $reclient = new Client(["base_uri" => $this->baseuri]);
    // get profile from api


    // dd($options);

    $request = $reclient->request('GET', 'image/' . $staff_no, $this->options)->getBody()->getContents();
    // $request->addHeader('Authorization: Bearer', '5a107934-68de-38cd-9a34-60fa4ae46267');
    // $resp = $reclient->send($request);

    // dd($request);

    $response = response()->make($request, 200);
    $response->header('Content-Type', 'image/jpeg'); // change this to the download content type.
    return $response;
  }

  public function taskHistoryCal(Request $req){

    if($req->filled('staff_no')){
      $staffno = $req->staff_no;
    } else {
      $staffno = backpack_user()->staff_no;
    }

    $counter = 0;
    $evlist = [];

    $st = User::where('staff_no', $staffno)->first();
    if($st){
      $tasklist = Task::where('assign_id', $st->id)
        ->where('status', 'Complete')->whereNotNull('rating_user')->get();

      foreach ($tasklist as $value) {
        Calendar::event(
            $value->name . '('.$value->rating_assign.')',
            false,
            new \DateTime($value->accepted_date),
            new \DateTime($value->submit_date),
            $value->id,[
              'url' => route('task.viewrequest', ['inputid' => $value->id]),
              'color' => $this->$borderColors[$counter%0]
            ]
          );
        $counter++;
      }
    }

    $cds = Calendar::addEvents($evlist);
    $this->addVar('cds', $cds);
    return view('user_calendar', $this->data);
  }

}
