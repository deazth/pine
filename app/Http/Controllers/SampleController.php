<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\CartaGeraf;
use App\User;
use \Calendar;

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

    $cds = Calendar::addEvents([]);
    $this->addVar('cds', $cds);
    return view('sample.kelendar', $this->data);
  }

  public function geraf(Request $req){

    $borderColors = [
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
        $fillColors = [
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


    $usersChart = new CartaGeraf;
    $usersChart->labels(['Jan', 'Feb', 'Mar']);
    $usersChart->dataset('Users by trimester', 'horizontalBar', [10, 25, 13])
      ->color($borderColors)
      ->backgroundcolor($fillColors);

     $cc2 = new CartaGeraf;
     $cc2->labels(['Jan', 'Feb', 'Mar']);
     $cc2->dataset('Buah', 'doughnut', [10, 25, 13])
      ->color($borderColors)
      ->backgroundcolor($fillColors);

    $this->addVar('chart1', $usersChart);
    $this->addVar('chart2', $cc2);

    return view('sample.graf', $this->data);
  }

  public function datable(){
    $u = User::all();

    return view('sample.datatable', ['users' => $u]);
  }
}
