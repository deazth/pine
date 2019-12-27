<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{

  public function index(Request $req){
    return view('sample.kosong');
  }

  public function wijjet(Request $req){

    $this->addAlert('danger', 'lorem ipsum yada yada', 'tajuk');
    $this->addAlert('success', 'lorem lorem ipsum lorem', 'title');
    $this->addAlert('info', 'kajang pak malau', 'nom');

    $w_progress = [
        'type'        => 'progress',
        'class'       => 'card text-white bg-primary mb-2',
        'value'       => '11.456',
        'description' => 'Registered users.',
        'progress'    => 57, // integer
        'hint'        => '8544 more until next milestone.',
    ];

    $this->addAfterContent($w_progress);

    return view('sample.wijet', $this->data);
  }

  public function home(Request $req){
    return view('sample.kelendar');
  }

  public function geraf(Request $req){
    return view('sample.graf', $this->data);
  }
}
