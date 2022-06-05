<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Cart;
use App\buy;
use App\User;
use Stripe;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class StripeController extends Controller
{
    
    /**
     * payment view
     */
    public function handleGet($login_id)
    {
       
        if(session()->has('id'))
        {
            $rows= DB::table('carts')->where('user_id',$login_id)->get();
            //print_r($rows);
            
            
            $i=0;
            $card_all_data=array();
            foreach($rows as $row)
            {
                
                 
                $product_row=Product::find($row->product_id);
              
                $cartData=array(
                    'id'=>$row->id,
                    'product_id'=>$row->product_id,
                    'product_price'=>$product_row->price,
                    'no_of_product'=>$row->no_product,
                    'total_price'=>$product_row->price * $row->no_product

                );
                $card_all_data[$i]=$cartData;
                $i++;
                
            }
            
            $total=0;
            for($c=0;$c<count($card_all_data);$c++)
            {
                $total=$total+$card_all_data[$c]['total_price'];
            }
            //echo "total amount :".$total;
            

            return view('card_form',['amount'=>$total]);
        }
        else
        {
            return redirect('login')->with('msg','please login after that You buy this product thank you..!');
        }
        
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
  
           // return back()->with('msg','Payment has been succeed. plz check your mail');
         
        $user_id=session('id');
        $card=$request->stripeToken;
        $user=User::find( $user_id);
        $email=$user->email;
        $amount=$request->input('amount');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create(array(
            "source" =>$card,
            "email" =>$email,
            "description" => "smartphones")
        );
        $charge = \Stripe\Charge::create(array(
            "amount" =>$amount * 100,
            "currency" => "inr",
            "customer" => $customer->id)
        );
        
        $rows= DB::table('carts')->where('user_id',$user_id)->get();
        $billData=array();
        $i=0;
        foreach ($rows as $row)
        {
           buy::create([
                'product_id'=>$row->product_id,
                'no_product'=>$row->no_product,
                'user_id'=>$user_id,
                'cart_name'=>$request->input('name'),
                'trans_id'=>$charge->id,
                'cus_id'=>$customer->id,
                'card_no'=>$request->input('card_no')
                
            ]);
            $product_row=Product::find($row->product_id);
            $buy_row=DB::table('buys')->where('trans_id',$charge->id)->first();
            $order_date=$buy_row->created_at;
            $data=array(
                'trans_id'=>$charge->id,
                'cus_id'=>$customer->id,
                'card_no'=>'xxxx xxxx xxxx '.substr($request->input('card_no'),14),
                'email'=>$email,
                'trans'=>$amount,
                'name'=>$user->name,
                'product_name'=>$product_row->name,
                'product_price'=>$product_row->price,
                'product_id'=>$row->product_id,
                'no_product'=>$row->no_product,
                'total_price'=>$row->no_product * $product_row->price,
                'order_date'=>$order_date

            );
            $remove_row= Cart::find($row->id); 
            $remove_row->delete();
            $billData[$i]=$data;
            $i++;
            
        }
          if(empty($billData))
          {
              return redirect('home')->with('msg','transection failed..please select product thank you');
          }
           //echo "<pre>".print_($billData);die;
            Mail::to('testrevin@gmail.com')->send(new SendMail($billData));
            Session::flash('success', 'Payment has been successfully processed. and Payment bill sent   your mail..!');
            //return back();
            return view('billing',['rows'=>$billData]);

          
           
    }
  
    
}
