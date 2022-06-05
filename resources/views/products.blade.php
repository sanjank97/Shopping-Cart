<!DOCTYPE html>
<html lang="en">
<head>
  <title>Our Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" /> 
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>-->
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

  <style>
      .main-box{
          background:#fff;
          margin-top:10px;
      }
         .product-title{
            background:#eff6f7;
            border:1px solid rgba(0,0,0,.1);
            border-radius:3px;
            position:sticky;
            top:0px;
            z-index:5;
         }
          .product_heading{
            padding-top:5px;
          }
          .btn-buy{
            background:#f93715;
            padding: 4px 12px;
            font-size: 14px;
              margin-top:10px;
          
          }
          .btn-buy:hover{
              background:#e24f0d;
          }
        
            .item_no{
                background:red;
                font-size:14px;
                margin-left:6px;
                padding:3px 8px;
                border-radius:6px;
            }
            .btn-cart{
          background: #117a8b;
          color: #fff;
          padding: 4px 12px;
          font-size: 14px;
       }
       .btn-buyed{
          background: #e22807;
          padding: 4px 12px;
          font-size: 14px;
         }
  </style>
</head>
<body style="background:#eceaea;">
     <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2>"></div>
            <div class="col-md-8 main-box">
               @if(Session::has('msg'))
                   <div class="alert alert-success mt-2">
                      {{session('msg')}}
                   </div>
                 @endif  
                <div class="product-box">
                <div class="row p-2 mb-3 product-title">
                     <div class="col-4">
                        <div class="product_heading">
                          Our Products
                          @if(Session::has('user'))
                          <a class="btn btn-buyed text-white" href="{{url('order',session('id'))}}"><i class="fa fa-list-ul" aria-hidden="true"></i>
                            <span>My Order</sapn></a>
                            @endif
                        </div>
                     </div>
                     <div class="col-8">
                        <div class="product_cart text-right">
                        
                        <div class="cart-content">
                          @if(Session::has('user'))
                             <span>{{session('user')}}</span>
                             <span>/</span>
                             <a href="{{url('logout')}}">Logout</a>
                             @else
                           <a href="{{url('register')}}">Sign-in</a>
                           <span>/</span>
                           <a href="{{url('login')}}" class="mr-2">Log-in</a>
                           @endif
                           <?php
                             if(!session()->has('user'))
                                {
                                  if(!session()->has('user_id'))
                                  {
                                    $login_user='not_registered';
                                    $login_id='not_registered';
                                  }
                                  else
                                  {
                                    $login_user=session('user_id');
                                    $login_id=session('user_id');
                                  }
                                  
                                }
                                else
                                {
                                  $login_user=session('user');
                                  $login_id=session('id');
                                }
                              ?>
                            <a class="btn btn-cart text-white" href="{{url('cart',$login_id)}}"><i class="fa fa-cart-plus" aria-hidden="true"></i>
                            <span>Cart</sapn><spna class="item_no"></span></a>
                        </div>
                        </div>
                     </div>
                </div>


                <?php 
                    foreach($products as $product)
                        { ?>
                     <div class="row">
                        <div class="col-xl-6 text-center">
                             <img src="{{url('/upload/',$product->photo)}}" width="100px;">
                          </div>
                          <div class="col-xl-6">
                              <h3>{{$product->name}}</h3>
                              <p>{{$product->description}}</p>
                              <p>${{$product->price}}</p>
                              <a href="{{url('addToCart',$product->id)}}" class="btn btn-buy text-white">Add To Cart</a>
                          </div>
                         </div>
                     <hr>
                     <?php
                        } 
                    ?>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
        </div>
     </div>
     <script>
       
          $(document).ready(function(){
                 if($('.item_no').html()=="")
                 {
                  $('.item_no').html("0");
                 }  


                $.ajax({
                 method:'get',   
                 url: "{{url('cartData',$login_id)}}",
                 dataType: 'text',
                 success: function(response) {
                   console.log(response);  
                 $('.item_no').html(response);
                },
                error: function(xhr) {
                    console.log('error');    
                }
                });
                $('.btn-cart').click(function(e){
                   if($('.item_no').html()==0)
                  {
                   e.preventDefault();
                   alert("Add product in cart..!");
                   }
                });
           
        
          });
     </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
</body>
</html>