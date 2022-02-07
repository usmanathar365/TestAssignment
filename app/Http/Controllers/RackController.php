<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;
use App\Rack;
class RackController extends Controller
{
    public function Racks(){
        
          $Racks=Rack::get();
          
          return view('Admin.Racks',compact('Racks'));
         
      }
      public function AddRack(){
          if (Auth::user()->role == 1){
       return view('Admin.AddRack');  
          } 
          else{
              return redirect()->back();
          }         
      }
      public function SaveRack(Request $request){       
          $rules = array(
              'name'        => 'required|string|min:3|max:255',
               
          );
          
          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
              $messages = $validator->messages();
              return redirect()->route('add.Rack')
                  ->withErrors($validator)->withInput();;
          }
          
          else{
              
              $Rack=new Rack();
              $Rack->name=$request->name;
              $Rack->save();
              return redirect()->route('Rack')->with('message','Rack Added');
          
          }
      
      }

     public function EditRack(Request $request){
      if (Auth::user()->role == 1){
      $id=$request->editid;
      $Rack=Rack::find($id);
      return view('Admin.AddRack',compact('Rack'));  
      }
      else{
          return redirect()->back();
      } 
     }
     public function UpdateRack(Request $request){
          
          $rules = array(
              'name' => 'required|string|min:3|max:255',
          
          );
          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
              $messages = $validator->messages();
              return redirect()->route('add.Rack')
                  ->withErrors($validator)->withInput();
          }
          else{
              $Rack=Rack::find($request->Rack_id);
              $Rack->name=$request->name;
              $Rack->update();
              return redirect()->route('Rack')->with('message','Rack Updated');
          }
     }
      public function DeleteRack(){
              $id=request()->query('id');
              Rack::where('id',$id)->delete();
              return 'ok';
      }
}
