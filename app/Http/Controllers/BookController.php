<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;
use App\Book;
use App\Rack;
use DB;
class BookController extends Controller
{
    public function Books(){
        
          $Books=Book::get();
        
          return view('Admin.Books',compact('Books'));
        
      }
      public function AddBook(){
          if (Auth::user()->role == 1){
        $Racks=Rack::get();
        return view('Admin.AddBook',compact('Racks'));  
          } 
          else{
              return redirect()->back();
          }         
      }
      public function SaveBook(Request $request){       
          $rules = array(
              'rack'       => 'required',
              'title'         => 'required|unique:books|string|min:3|max:255',
              'author'        => 'required|string|min:3|max:255',
              'publish_year'  => 'required',
               
          );
          
          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
              $messages = $validator->messages();
              return redirect()->route('add.Book')
                  ->withErrors($validator)->withInput();
          }
          else{
          $Books=Book::where('rack_id',$request->rack)->get();
          
          if(count($Books) >= 2){
                  return redirect()->back()->withErrors(['msg' => "Sorry, You can't add more then 10 books in one rack."]);
              }
              $Book=new Book();
              $Book->rack_id=$request->rack;
              $Book->title=$request->title;
              $Book->author=$request->author;
              $Book->published_year=$request->publish_year;
              $Book->save();
              return redirect()->route('Book')->with('message','Book Added');
          
          }
      
      }
     public function EditBook(Request $request){
      if (Auth::user()->role == 1){
      $id=$request->editid;
      $Book=Book::find($id);
      $Racks=Rack::get();
      return view('Admin.AddBook',compact('Book','Racks'));  
      }
      else{
          return redirect()->back();
      } 
     }
     public function UpdateBook(Request $request){
          
          $rules = array(
            'rack'       => 'required',
            'title'         => 'required|string|min:3|max:255',
            'author'        => 'required|string|min:3|max:255',
            'publish_year'  => 'required',
          
          );
          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
              $messages = $validator->messages();
              return redirect()->route('add.Book')
                  ->withErrors($validator)->withInput();
          }
          else{
              $Book=Book::find($request->Book_id);
              $Book->rack_id=$request->rack;
              $Book->title=$request->title;
              $Book->author=$request->author;
              $Book->published_year=$request->publish_year;
              $Book->update();
              return redirect()->route('Book')->with('message','Book Updated');
          }
     }
      public function DeleteBook(){
              $id=request()->query('id');
              Book::where('id',$id)->delete();
              return 'ok';
      }
}
