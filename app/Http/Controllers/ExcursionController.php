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
      //$excursions = Cruize::All();
      //return view('cruize.index',compact('excursions'));
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
      $this->validate($request, [
          'title' => 'required',
          'from' => 'required',
          'to' => 'required',
          'time' => 'required',
          'price' => 'required',
          'max_number_of_guest' => 'required',
      ]);

      Excursion::create($request->all());
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
}
