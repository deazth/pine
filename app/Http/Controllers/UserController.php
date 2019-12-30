<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{

  protected $baseuri = "https://api.oip.tm.com.my/app/t/tmrnd.com.my/era/1.0.0/profile/";
  protected $options = [
    'query' => ['api_key' => 'Z9HYE86CIElVjTEJuDOy2eBWPrL96et41wUmjL3M'],
    'headers' => ['Authorization' => 'Bearer 5a107934-68de-38cd-9a34-60fa4ae46267']
  ];

  public function showProfile(Request $req){

    if($req->filled('staff_no')){
      $staffno = $req->staff_no;
    } else {
      // dd('own');
      // dd(backpack_user()->staff_no);
      $staffno = backpack_user()->staff_no;
    }

    return $this->getStaffImage($staffno);

  }




  private function getStaffProfile($staff_no){
    $reclient = new Client(["base_uri" => $this->baseuri]);
    // get profile from api


    // dd($options);

    $request = $reclient->request('GET', 'info/' . $staff_no, $this->options)->getBody()->getContents();
    // $request->addHeader('Authorization: Bearer', '5a107934-68de-38cd-9a34-60fa4ae46267');
    // $resp = $reclient->send($request);

    return json_decode($request);
  }

  private function getStaffImage($staff_no){
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
