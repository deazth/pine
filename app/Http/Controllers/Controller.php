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
