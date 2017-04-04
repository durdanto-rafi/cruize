<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cruize;

class CruizeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $cruizes = Cruize::orderBy('id','DESC')->paginate(5);
      //$cruizes = Cruize::All();
      //return view('cruize.index',compact('cruizes'));
      return view('cruize.index',compact('cruizes'))->with('i', ($request->input('page', 1) - 1) * 5);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('cruize.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      
      $this->validate($request, [
          'name' => 'required',
          'ship_name' => 'required',
          'from' => 'required',
          'to' => 'required',
      ]);

      $cruize = new Cruize;
      $cruize->name = $request->get('name');
      $cruize->ship_name = $request->get('ship_name');
      $cruize->from = date('Y-m-d', strtotime($request->get('from')));
      $cruize->to = date('Y-m-d', strtotime($request->get('to')));
      $cruize->save();
      


      return redirect()->route('cruize.index')->with('success','Cruize created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $Cruize = Cruize::find($id);
      return view('cruize.show',compact('Cruize'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $cruize = Cruize::find($id);
      return view('cruize.edit',compact('cruize'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      $this->validate($request, [
          'name' => 'required',
          'ship_name' => 'required',
          'from' => 'required',
          'to' => 'required',
      ]);

      Cruize::find($id)->update($request->all());
      return redirect()->route('cruize.index')
                      ->with('success','Cruize updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      Cruize::find($id)->delete();
      return redirect()->route('cruize.index')
                      ->with('success','Cruize deleted successfully');
  }

  public function getCruizes(){
      $cruizes = Cruize::All();
      return response()->json(['cruizes' => $cruizes], 200);	
  }


  /*
  * Excersion 
  */
  public function getExcersion($id){
      return view('excursion.create', compact('id'));
  }

  /*
  * Guest 
  */
  public function getGuest($id){
      return view('guest.create', compact('id'));
  }
}
