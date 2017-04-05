<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabin;

class CabinController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $cabins = Cabin::orderBy('id','DESC')->paginate(5);
      //$cabins = cabin::All();
      //return view('cabin.index',compact('cabins'));
      return view('cabin.index',compact('cabins'))->with('i', ($request->input('page', 1) - 1) * 5);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('cabin.create');
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
          'uniq_id' => 'required',
      ]);

      $cabin = new Cabin;
      $cabin->name = $request->get('name');
      $cabin->ship_name = $request->get('ship_name');
      $cabin->from = date('Y-m-d', strtotime($request->get('from')));
      $cabin->to = date('Y-m-d', strtotime($request->get('to')));
      $cabin->uniq_id = $request->get('uniq_id');
      $cabin->save();
      
      return redirect()->route('cabin.index')->with('success','cabin created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $cabin = Cabin::find($id);
      return view('cabin.show',compact('cabin'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $cabin = Cabin::find($id);
      return view('cabin.edit',compact('cabin'));
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

      Cabin::find($id)->update($request->all());
      return redirect()->route('cabin.index')
                      ->with('success','cabin updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      Cabin::find($id)->delete();
      return redirect()->route('cabin.index')
                      ->with('success','cabin deleted successfully');
  }

  /**
   * Display a listing of the resource as JSON.
   *
   * @return json
   */
  public function getcabins(){
      $cabins = Cabin::All();
      return response()->json(['cabins' => $cabins], 200);	
  }


  /**
   * Store a newly created resource in storage from API.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function postCabin(Request $request){
      $cabin = new Cabin();
      $cabin->cabin_number = $request->input('cabin_number');
      $cabin->guest_id = $request->input('guest_id');
      $cabin->number_of_guest = $request->input('number_of_guest');
      $cabin->payment_status = $request->input('payment_status');
      $cabin->uniq_id = $request->input('uniq_id');
      $cabin->save();

      return response()->json(['cabin' => $cabin], 201);
  }
}
