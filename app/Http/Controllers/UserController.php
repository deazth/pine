<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Charts\CartaGeraf;
use App\User;

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

    // get lifetime stats
    $cuser = User::where('staff_no', $staffno)->first();
    if($cuser){
      $usersChart = new CartaGeraf;
      $usersChart->labels(['Jan', 'Feb', 'Mar']);
      $usersChart->title('Average Rating: 2.4');
      $usersChart->dataset('Users by trimester', 'horizontalBar', [10, 25, 13])
        ->color($this->borderColors)
        ->backgroundcolor($this->fillColors);

      $this->addVar('chart1', $usersChart);
    }

    $cc2 = new CartaGeraf;
    $cc2->labels(['Jan', 'Feb', 'Mar']);
    $cc2->dataset('Buah', 'pie', [10, 25, 13])
      ->color($this->borderColors)
      ->backgroundcolor($this->fillColors);


    $this->addVar('chart2', $cc2);

    $this->addVar('info', $this->getEraProfile($staffno));


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
    }

    return $ret;

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
}
