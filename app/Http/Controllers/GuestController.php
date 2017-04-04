<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;

class GuestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $guests = Guest::orderBy('id','DESC')->paginate(5);
      //$guests = guest::All();
      //return view('guest.index',compact('guests'));
      return view('guest.index',compact('guests'))->with('i', ($request->input('page', 1) - 1) * 5);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('guest.create');
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
          'first_name' => 'required',
          'last_name' => 'required',
      ]);

      Guest::create($request->all());
      return redirect()->route('guest.index')->with('success','Guest created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $guest = Guest::find($id);
      return view('guest.show',compact('guest'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $guest = Guest::find($id);
      return view('guest.edit',compact('guest'));
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
          'first_name' => 'required',
          'last_name' => 'required',
      ]);

      Guest::find($id)->update($request->all());
      return redirect()->route('guest.index')->with('success','Guest updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      Guest::find($id)->delete();
      return redirect()->route('guest.index')->with('success','Guest deleted successfully');
  }
}
