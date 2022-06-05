<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class AddProductController extends Controller
{
    public function callAddProduct()
    {
        return view('addProductForm');
    }
    public function addProduct(Request $request)
    {
       $data=$request->all();
       $validatedData=[
           'name'=>'required',
           'description'=>'required',
           'file'=>'required',
           'price'=>'required|regex:/^[0-9]*$/'
       ];
       $customMessages = [
                
        'price.regex' => 'The :attribute field should be only numeric value.'
       ]; 
         $this->validate($request, $validatedData , $customMessages);
         $filename=time().".".$request->file->extension();
         $request->file->move(public_path('upload'), $filename);
         $name=$request->name;
         $description=$request->description;
         $price=$request->price;
         Product::create([
             'name'=>$name,
             'description'=>$description,
             'photo'=>$filename,
             'price'=>$price
         ]);
        return redirect('addProduct')->with('msg','Product Added Successfully');
         
     }
}
