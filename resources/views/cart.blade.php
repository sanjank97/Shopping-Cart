
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" /> 
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>-->
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
  <style>
      .main-box{
          background:#eceaea;
          margin-top:10px;
      }
      .product-title{
            background:#eff6f7;
            border:1px solid rgba(0,0,0,.1);
            border-radius:5px;}

            .btn-cart{
          background: #117a8b;
          color: #fff;
          padding: 4px 12px;
          font-size: 14px;
       }
        .item_no{
                background:red;
                font-size:14px;
                margin-left:6px;
                padding:3px 8px;
                border-radius:6px;
            }
         .my-btn{padding:5px 2px;} 
         .my-achor{
             padding:8px 16px;
             
         }  
         .btn-buyed{
          background: #e22807;
          padding: 4px 12px;
          font-size: 14px;
         }
  </style>
</head>
<body >
     <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2>"></div>
            <div class="col-md-8 main-box">
                <div class="product-box">
                    <div class="row p-2 mb-2 product-title">
                        <div class="col-6">
                            <div class="pt-2">
                            Cart Products
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="product_cart text-right">
                                <div class="cart-content">
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
                                    <a class="btn btn-cart text-white" href="{{url('cart',$login_id)}}"><i class="fa fa-cart-plus " aria-hidden="true"></i>
                                    <span>Cart</sapn><spna class="item_no"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                        <table class="table bg-white">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $total=0;
                     
                            foreach($rows as $row)
                            {
                                $photo=$row['product_photo'];
                                ?>
                                <tr>
                                    <td><img src="{{url('public/upload/',$photo)}}" width="30px"><?php echo $row['product_name'] ?></td>

                                    <td><?php echo '<strong>$</strong> '.$row['product_price'];?></td>
                                    <form action="{{url('refresh')}}">
                                    <td><input class="form-control text-center" style="width:100px;" type="number" name="no_product" value="<?php echo $row['no_of_product'];?>" min="1" max="20"></td>
                                     <input type="text" name="id" value="{{$row['id']}}" hidden>
                                    <td><?php echo '<strong>$</strong> '.$row['total_price'];?></td>

                                    <td><button type="submit" class="alert alert-success text-center my-btn" style="width:50px;"><i class="fa fa-refresh" aria-hidden="true"></i></button></td>
                                    </form>
                                    <td class="pt-3"><a href="{{url('delete',$row['id'])}}" class="alert alert-danger text-center my-achor" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                </tr> 

                                <?php
                                $total=$total+$row['total_price'];
                            }
                             
                            ?>
                              <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                              </tr>  
                              <tr>
                                <td><a href="{{url('payment',$login_id)}}"class="btn btn-buyed text-white">Continue shopping</a></td>
                                <td></td>
                                <td></td>
                                <td><?php echo '<strong>$</strong> '.$total; ?></td>
                              </tr> 
                            </tbody>
                        </table>
                       <div class="text-right pb-2"> <a href="{{url('home')}}" class="btn btn-cart text-white">Go To Shopping</a></div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
        </div>
     </di<v>
     <script>
         
          $(document).ready(function(){
            
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
              
        
          });
     </script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
</body>
</html>