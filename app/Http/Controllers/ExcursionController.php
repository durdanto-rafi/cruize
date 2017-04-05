<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Excursion;

class ExcursionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $excursions = Excursion::orderBy('id','DESC')->paginate(5);
      return view('excursion.index',compact('excursions'))->with('i', ($request->input('page', 1) - 1) * 5);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('excursion.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //echo $request->get('cruize_id'); exit;
      $this->validate($request, [
          'title' => 'required',
          'from' => 'required|date',
          'to' => 'required|date',
          'time' => 'required',
          'price' => 'required|numeric',
          'max_number_of_guest' => 'required|integer',
          'cruize_id' => 'required',
          'uniq_id' => 'required',
      ]);

      $excursion = new Excursion;
      $excursion->title = $request->get('title');
      $excursion->cruize_id = $request->get('cruize_id');
      $excursion->from = date('Y-m-d', strtotime($request->get('from')));
      $excursion->to = date('Y-m-d', strtotime($request->get('to')));
      $excursion->time = $request->get('time');
      $excursion->price = $request->get('price');
      $excursion->max_number_of_guest = $request->get('max_number_of_guest');
      $excursion->uniq_id = $request->get('uniq_id');
      $excursion->save();

      return redirect()->route('excursion.index')->with('success','Excuision created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $excursion = Excursion::find($id);
      return view('excursion.show',compact('excursion'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $excursion = Excursion::find($id);
      return view('excursion.edit',compact('excursion'));
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
          'title' => 'required',
          'from' => 'required',
          'to' => 'required',
          'time' => 'required',
          'price' => 'required',
          'max_number_of_guest' => 'required',
          'cruize_id' => 'required',
          'uniq_id' => 'required',
          
      ]);

      Excursion::find($id)->update($request->all());
      return redirect()->route('excursion.index')->with('success','Excuision updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      Excursion::find($id)->delete();
      return redirect()->route('excursion.index')->with('success','Excuision deleted successfully');
  }

  /**
   * Display a listing of the resource as JSON.
   *
   * @return json
   */
  public function getExcursions()
  {
      $excursions = Excursion::All();
      return response()->json(['excursions' => $excursions], 200);	
  }
}
