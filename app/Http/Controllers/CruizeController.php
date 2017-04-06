<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cruize;
use Excel;

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
      $cruize->uniq_id = $request->get('uniq_id');
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

      $cruize = new Cruize;
      $cruize->name = $request->get('name');
      $cruize->ship_name = $request->get('ship_name');
      $cruize->from = date('Y-m-d', strtotime($request->get('from')));
      $cruize->to = date('Y-m-d', strtotime($request->get('to')));
      $cruize->uniq_id = $request->get('uniq_id');

      Cruize::find($id)->update($cruize);
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

  /**
   * Display a listing of the resource as JSON.
   *
   * @return json
   */
  public function getCruizes()
  {
      $cruizes = Cruize::All();
      return response()->json(['cruizes' => $cruizes], 200);	
  }


  /*
  * Excersion 
  */
  public function getExcersion($id)
  {
      return view('excursion.create', compact('id'));
  }

  /*
  * Guest 
  */
  public function getGuest($id)
  {
      return view('guest.create', compact('id'));
  }

  /**
   * Store a newly created resource in storage from API.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function postCruize(Request $request)
  {
      $cruize = new Cruize;
      $cruize->name = $request->get('name');
      $cruize->ship_name = $request->get('ship_name');
      $cruize->from = date('Y-m-d', strtotime($request->get('from')));
      $cruize->to = date('Y-m-d', strtotime($request->get('to')));
      $cruize->uniq_id = $request->get('uniq_id');
      $cruize->save();

      return response()->json(['cruize' => $cruize], 201);
  }

  /**
   * Store a newly created resource in storage from API.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function postCruizes(Request $request)
  {
    $jsonData = $request->json()->all();
    $cruize = new Cruize;
    $data = [];
    foreach ($jsonData['cruizes'] as $cruize){
        $data[] = array(
          'name' => $cruize['name'],    
          'ship_name' => $cruize['ship_name'],  
          'from' => $cruize['from'],
          'to' => $cruize['to'],
          'uniq_id' => $cruize['uniq_id']
        );
    };

    Cruize::insert($data); 
    return response()->json($data, 200, array(), JSON_PRETTY_PRINT);
    //return response()->json($data, 200, array(), JSON_PRETTY_PRINT);
  }

  /**
  * Return View file
  *
  * @var array
  */
	public function importExport()
	{
		  return view('importExport');
	}

	/**
  * File Export Code
  *
  * @var array
  */
	public function downloadExcel(Request $request, $type)
	{
      $data = Item::get()->toArray();
      return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
            {
              $sheet->fromArray($data);
            });
      })->download($type);
	}

	/**
  * Import file into database Code
  *
  * @var array
  */
	public function importExcel(Request $request)
	{
      if($request->hasFile('import_file')){
          $path = $request->file('import_file')->getRealPath();
          $data = Excel::load($path, function($reader) {})->get();
          if(!empty($data) && $data->count()){
            foreach ($data->toArray() as $key => $value) {
                if(!empty($value)){
                    foreach ($value as $v) {		
                        $insert[] = ['title' => $v['title'], 'description' => $v['description']];
                    }
                }
            }

            if(!empty($insert)){
                echo $insert; exit;
                return back()->with('success','Insert Record successfully.');
            }
          }
      }
      return back()->with('error','Please Check your file, Something is wrong there.');
	}
}
