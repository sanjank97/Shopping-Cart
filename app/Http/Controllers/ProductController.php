<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Cart;
use App\User;
use App\dummy_cart;
class ProductController extends Controller
{
    public function index()
    {
        $rows = DB::table('products')->get();
        return view('products',['products'=>$rows]);
    }
    public function addToCart($id)
    {

        if(session()->has('user'))
        {
          
            $product_row=Product::find($id);
            if(empty($product_row))
            {
                echo "product Not Found";
            }
            else
            {
                $cart_row= DB::table('carts')->where('product_id',$id)->get();
               print_r("<pre>".$cart_row."</pre>");
            
                $flag=0;
                if(!$cart_row->isEmpty())
                {
                   foreach($cart_row as $row)
                   {

                       if($row->user_id==session('id'))
                       {
                        echo "hello";
                        $flag=1;
                        $row_id=$row->id;
                        $row=Cart::find($row_id);
                        $no_product=$row->no_product;
                        $row->no_product=$no_product+1;
                        $row->save();
                       return back()->with('msg','product added to cart successfully !');
                       }
                       else
                       {
                        $flag=0;
              
                       }
                   }
                   if($flag==0)
                   {
                       
                    Cart::create([
                        'product_id'=>$id,
                        'no_product'=>1,
                        'user_id'=>session('id')     
                    ]); 
                    return back()->with('msg','product added to cart successfully !'); 
                   echo "hiiiiii";
                   }

                }
                else
                {
                    
                    echo "bye";
                  Cart::create([
                        'product_id'=>$id,
                        'no_product'=>1,
                        'user_id'=>session('id')     
                    ]);
                    return back()->with('msg','product added to cart successfully !');
                }

            }
        }
        //////////////////////////// here Adding cart without login......
        else
        { 
             $product_row=Product::find($id);
             if(empty($product_row))
             {
                 echo "product Not Found";
             }
             else
             {
                if(!session()->has('user_id'))
                {
                    $dummy_user=mt_rand(99,999).time();
                    dummy_cart::create([
                        'product_id'=>$id,
                        'no_product'=>1,
                        'user_id'=> $dummy_user   
                    ]);
                    $dummy_cart_row= DB::table('dummy_carts')->where('product_id',$id)->first();
                    session(['user_id'=>$dummy_cart_row->user_id]);
                    
                    return back()->with('msg','product added to cart successfully !'); 
                    
                }
                else
                {
                    $dummy_cart_row= DB::table('dummy_carts')->where('product_id',$id)->get();
            
                   $flag=0;
                    if(!$dummy_cart_row->isEmpty())
                    {
                       echo count($dummy_cart_row);
                       foreach($dummy_cart_row as $row)
                       {
                          if($row->user_id==session('user_id'))
                          {
                              echo "hello";
                              $flag=1;
                              $row_id=$row->id;
                              $row=dummy_cart::find($row_id);
                              $no_product=$row->no_product;
                              $row->no_product=$no_product+1;
                              $row->save();
                              return back()->with('msg','product added to cart successfully !');
                          }
                          else
                          {
                              $flag=0;
                          }
                        
                       }
                       if($flag==0)
                       {
                        dummy_cart::create([
                            'product_id'=>$id,
                            'no_product'=>1,
                            'user_id'=> session('user_id') 
                        ]);
                        
                        return back()->with('msg','product added to cart successfully !');
                        }
                      
                     }
                    else
                        {
                            dummy_cart::create([
                                'product_id'=>$id,
                                'no_product'=>1,
                                'user_id'=> session('user_id') 
                            ]);
                            
                            return back()->with('msg','product added to cart successfully !');    
                        }
                }
                         
          }
     }
                
}

    
    public function cartData($user)
    {
        if(session()->has('user'))
        { 
            $rows= DB::table('carts')->where('user_id',$user)->get();
            $total_item=0;
            foreach($rows as $row)
            {
                $total_item=$total_item+$row->no_product;
            }
            echo $total_item;
        }
        elseif(session()->has('user_id'))
        {
                $rows= DB::table('dummy_carts')->where('user_id',$user)->get();
                $total_item=0;
                foreach($rows as $row)
                {
                    $total_item=$total_item+$row->no_product;
                }
                echo $total_item;
        }
       else
       {
                echo '0';
       }
       
    }
    public function displayCartData($user)
    {

        if(session()->has('user'))
        {
            $rows= DB::table('carts')->where('user_id',$user)->get();
            $i=0;
            $card_all_data=array();
            foreach($rows as $row)
            {
                $product_row=Product::find($row->product_id);
                $cartData=array(
                    'id'=>$row->id,
                    'product_id'=>$row->product_id,
                    'product_photo'=>$product_row->photo,
                    'product_name'=>$product_row->name,
                    'product_price'=>$product_row->price,
                    'no_of_product'=>$row->no_product,
                    'total_price'=>$product_row->price * $row->no_product

                );
                $card_all_data[$i]=$cartData;
                $i++;
                
            }
        }
        else 
        {
            if(session()->has('user_id'))
            {
                $rows= DB::table('dummy_carts')->where('user_id',$user)->get();
                $i=0;
                $card_all_data=array();
                foreach($rows as $row)
                {
                    $product_row=Product::find($row->product_id);
                    $cartData=array(
                        'id'=>$row->id,
                        'product_id'=>$row->product_id,
                        'product_photo'=>$product_row->photo,
                        'product_name'=>$product_row->name,
                        'product_price'=>$product_row->price,
                        'no_of_product'=>$row->no_product,
                        'total_price'=>$product_row->price * $row->no_product
    
                    );
                    $card_all_data[$i]=$cartData;
                    $i++;
                    
                }
            }
            else
            {
                return back()->with('msg','Empty..! please add to cart');
            }

        }
        if(empty($card_all_data))
        {
          return redirect('home');
        }
       return view('cart',['rows'=>$card_all_data]); 
    }
    public function quantityUpdate(Request $request)
    {
        echo "no_product: ".$no_product=$request->input('no_product');
        echo " id ".$id= $request->input('id');
        if(session()->has('user'))
        {
            $cart_row = Cart::find($id);
            $cart_row->no_product=$no_product;
            $cart_row->save();
            return back();
        }
        if(session()->has('user_id'))
        {
            $cart_row = dummy_cart::find($id);
            $cart_row->no_product=$no_product;
            $cart_row->save();
            return back();
        }
    

    }
    public function quantitydelete($id)
    {
        if(session()->has('user'))
        {
            $cart_row = Cart::find($id);
            $cart_row->delete();
            return back();
        }
        else
        {
            $cart_row = dummy_cart::find($id); 
            $cart_row->delete();
            return back();
        }

    }
    public function myOrder($user)
    {
       if(session()->has('user'))
       {
           
           $rows= DB::table('buys')->where('user_id',$user)->get();
           $orderData=array();
           $i=0;
           foreach($rows as $row)
           {
              
               $user_row=User::find($row->user_id);
               $product_row=Product::find($row->product_id);
            
               $data=array(
                'trans_id'=>$row->trans_id,
                'cus_id'=>$row->cus_id,
                'card_no'=>'xxxx xxxx xxxx '.substr($row->card_no,14),
                'email'=>$user_row->email,
                'product_name'=>$product_row->name,
                'product_desc'=>$product_row->description,
                'product_photo'=>$product_row->photo,
                'product_price'=>$product_row->price,
                'no_product'=>$row->no_product,
                'total_price'=>$product_row->price * $row->no_product,
                'order_date'=>$row->created_at

            );
             $orderData[$i]=$data;
             $i++;


           }
           return view('order',['rows'=>$orderData]);
       }




       
    }
}
