<?php

namespace App\Http\Controllers;

use App\EraSkillset;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EraSkillsetController extends Controller
{

  protected $baseuri = "https://api.oip.tm.com.my/app/t/tmrnd.com.my/era/1.0.0/skillset/search/";
  protected $options = [
    'query' => ['api_key' => 'Z9HYE86CIElVjTEJuDOy2eBWPrL96et41wUmjL3M'],
    'headers' => ['Authorization' => 'Bearer 5a107934-68de-38cd-9a34-60fa4ae46267']
  ];
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
    public function store($keyword)
    {
      $reclient = new Client(["base_uri" => $this->baseuri]);
        $request = $reclient->request('GET', $keyword, $this->options)->getBody()->getContents();



return $request;






        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EraSkillset  $eraSkillset
     * @return \Illuminate\Http\Response
     */
    public function show(EraSkillset $eraSkillset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EraSkillset  $eraSkillset
     * @return \Illuminate\Http\Response
     */
    public function edit(EraSkillset $eraSkillset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EraSkillset  $eraSkillset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EraSkillset $eraSkillset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EraSkillset  $eraSkillset
     * @return \Illuminate\Http\Response
     */
    public function destroy(EraSkillset $eraSkillset)
    {
        //
    }
}
