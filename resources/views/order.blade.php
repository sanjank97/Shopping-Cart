
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
           background:#f34007;
           color:#fff;
           padding:3px 12px;
           font-size:14px;
       }
       
  </style>
</head>
<body >
     <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2>"></div>
            <div class="col-md-8 main-box">
                <div class="product-box">
                    <div class="row p-3 mb-3 product-title">
                         <div>
                             My Order
                         </div>
                    </div>
                 
                        <table class="table bg-white" style="font-size:14px;">
                            <thead>
                            <?php
                                  if(empty($rows))
                                  {
                                    ?>
                                 <tr class="text-center p-2"><th><h3>Product Not Found...!</h3></th></tr>
                                  <?php
                                  }
                                  else
                                  {
                            ?>
                                <tr>
                                    <th>Product</th>
                                    <th>Product Details</th>
                                    
                                </tr>
                            </thead>
                             <tbody>
                                 <?php
                                 foreach($rows as $row){?>
                               <tr>
                                    <td>
                                      <div><Strong>{{$row['product_name']}}</Strong></div>
                                       <img width="100px;" src="{{url('upload',$row['product_photo'])}}" alt="product image"></img>
                                       
                                    </td>
                                    <td>
                                       <div class="row">
                                            <div class="col-4">
                                             Transection ID
                                            </div>
                                            <div class="col-8">
                                              {{$row['trans_id']}}
                                            </div>
                                       </div>
                                       <div class="row mt-2">
                                            <div class="col-4">
                                                Payment Card
                                            </div>
                                            <div class="col-8">
                                                 {{$row['card_no']}}
                                            </div>
                                       </div>
                                       <div class="row mt-2">
                                            <div class="col-4">
                                             Customer ID
                                            </div>
                                            <div class="col-8">
                                            {{$row['cus_id']}}
                                            </div>
                                       </div>
                                       <div class="row mt-2">
                                            <div class="col-4">
                                             Order Date
                                            </div>
                                            <div class="col-8">
                                            {{$row['order_date']}}
                                            </div>
                                       </div>
                                       <div class="row mt-2">
                                            <div class="col-4">
                                                Description
                                            </div>
                                            <div class="col-8">
                                            {{$row['product_desc']}}
                                            </div>
                                       </div>
                                       <div class="hide_field">
                                       <div class="row mt-2">
                                            <div class="col-4">
                                                Price
                                            </div>
                                            <div class="col-8">
                                            {{$row['product_price']}}
                                            </div>
                                       </div>
                                       <div class="row mt-2">
                                            <div class="col-4">
                                                No. of product
                                            </div>
                                            <div class="col-8">
                                            {{$row['no_product']}}
                                            </div>
                                       </div>
                                       <div class="row mt-2">
                                            <div class="col-4">
                                            Total Price
                                            </div>
                                            <div class="col-8">
                                            {{$row['total_price']}}
                                            </div>
                                       </div>
                                       <div class="row mt-2">
                                            <div class="col-4">
                                               Email 
                                            </div>
                                            <div class="col-8">
                                            {{$row['email']}}
                                            </div>
                                       </div>

                                     </div>
                                     <div class="row mt-2">
                                            <div class="col-4">
                                               
                                            </div>
                                            <div class="col-8 mt-2">
                                                <button class="btn btn-cart text-white mybtn" attr="more">more</button>
                                                <a class="btn btn-danger" style="padding:3px 12px; font-size:14px;" >Cancel</a>
                                            </div>
                                       </div>
                                    
                                    </td> 
                                    
                                  </tr>
                                 <?php }}?>
                             </tbody>
                        </table> 
                       <div class="text-right pb-2"> <a href="{{url('home')}}" class="btn btn-cart text-white">Go To Shopping</a></div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
        </div>
     </div>
     <script>
           $(document).ready(function(){
            $('.hide_field').hide();
            
             $('.mybtn').click(function(){
               $('.hide_field').toggle();
               
             });
           });
     </script>
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
</body>
</html>