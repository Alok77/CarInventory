<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/data',  function (Request $request) {
    return App\CarModel::with('images')->with('Manufacturer')->get();
});
Route::post('/CreateManufacturer',  function (Request $request) {
$x = new App\Manufacturer();
$x->Name = $request->name;
$x->save();
return "Manufacturer Added";
});
Route::post('/CreateCarModel',  function (Request $request) {
//return $request->name.'1'.$request->count.'2'.$request->color.'3'.$request->note.'4'.$request->year.'5'.$request->register.'6'.$request->Manufacture_id;
$x = new App\CarModel();
$x->ModelName = $request->name;
$x->color = $request->color;
$x->count = $request->count;
$x->note = $request->note;
$x->ManufactureYear = $request->year;
$x->RegistrationNumber   = $request->register;
$x->Manufacturer_id   = $request->Manufacture_id;
$x->save();

$y = $x->id;

if($request->hasFile('files')){
   $Data = array();
   foreach($request->file('files') as $file){
   $ext = $file->getClientOriginalExtension();
   $ghtyu = $file->getClientOriginalName();
     $namet = time().'_'.rand(10,999).'.'.$ext;
    $file->move(public_path('images'), $namet);
 
   $h = new App\Image();
   $h->model_id = $y;
   $h->image = $namet;
   $h->save();
    }
    } else {
   $dft = "null";
   }
return "Car Model Added";
});
Route::get('/ManufacturerList',  function (Request $request) {
    return App\Manufacturer::all();
});
