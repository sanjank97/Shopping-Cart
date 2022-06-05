<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Cart;
use App\dummy_cart;
class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
       $data=$request->all();
       $request->validate([
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:5']
        
    ]);
       
      $user= DB::table('users')->where('email',$request->input('email'))->first();
      if(!empty($user))
      {
        if($user->password==$request->input('password'))
        {

            session(['user'=>$user->name]);
            session(['id'=>$user->id]);
            if(session()->has('user_id'))
            {
              $rows= DB::table('dummy_carts')->where('user_id',session('user_id'))->get();
              if(!$rows->isEmpty())
              {
                foreach($rows as $row)
                {
                  echo $row->product_id;
                  echo "<br>";
                  echo $row->no_product;
                  echo "<br>";
                 $cart_rows= DB::table('carts')->where('user_id',session('id'))->get();
                  if(!$cart_rows->isEmpty())
                  {
                     $flag=0;
                    foreach($cart_rows as $cart_row)
                    {
                       if($cart_row->product_id==$row->product_id)
                       {
                         $flag=1;
                         $cart_row=Cart::find($cart_row->id);
                         $no_product=$cart_row->no_product;
                         $cart_row->no_product=$no_product+$row->no_product;
                         $cart_row->save();
                       }
                       else
                       {
                         $flag=0;
                   
                       }
                    }
                    if($flag==0)
                    {
                      Cart::create([
                        'product_id'=>$row->product_id,
                        'no_product'=>$row->no_product,
                        'user_id'=>session('id')     
                    ]); 
                    }
                  }
                  else
                  {
                    Cart::create([
                      'product_id'=>$row->product_id,
                      'no_product'=>$row->no_product,
                      'user_id'=>session('id')     
                  ]); 
                  }

                  $dummy_row= dummy_cart::find($row->id); 
                  $dummy_row->delete();
                }
                
            
              }
            }
            return redirect('home')->with('msg','You have logged successfully!');
        }
        else
        {
        
            return redirect('login')->with('msg','You have entered wrong password!');
        }
      }
      else
      {
        return redirect('login')->with('msg','You have entered wrong credentials!');
      }
   
    }
    public function logout()
    {
        session()->forget('user');
        session()->forget('id');
        session()->flush();
        return redirect('home')->with('msg','You have logged out !');
    }
}
