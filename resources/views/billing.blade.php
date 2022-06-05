<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyBill</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
      .my-box{
          
          background:#f5f0f0;
          padding:30px;
          font-size:14px; 
          
      }
      .bill-title{
          border:1px solid #ccc;
          padding:10px;
          background:#eff6f7;
      }
      .table{
          background:#fff;}
  </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-0 col-sm-0 col-md-2"></div>
            <div class="col-12 col-sm-12 col-md-8">
                <div class="my-box mt-2">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                          {{session('success')}}
                        </div>
                    @endif
                    <div class="bill-title">
                      Transection Details
                    </div>
                    <?php
                        foreach($rows as $row)
                       
                        $total=0;    

                    ?>
                      <table class="table table-bordered" style="font-size:14px; width:100%;">        
                          <tbody>
                              <tr>
                                <th>Transection ID</th>
                                <td colspan="3">{{$row['trans_id']}}</td>
                              </tr>
                              <tr>
                                <th>Customer ID</th>
                                <td colspan="3">{{$row['cus_id']}}</td>
                              </tr>
                              <tr>
                                <th>Order Date</th>
                                <td colspan="3">{{$row['order_date']}}</td>
                              </tr>
                              <tr>
                                <th>Cash By Card</th>
                                <td colspan="3">{{$row['card_no']}}</td>
                              </tr>
                              <tr>
                                <th>Transection(₹)</th>
                                <th>Email</th>
                                <th colspan="2">Name</th>
                              </tr>
                              <tr>
                                <td>{{$row['trans']}}</td>
                                <td>{{$row['email']}}</td>
                                <td colspan="2">{{$row['name']}}</td>
                              </tr>
                              <tr>
                                <th>Product Name</th>
                                <th>Total Product</th>
                                <th>Price</th>
                                <th>Total Price</th>
                              </tr>
                              <?php foreach($rows as $row){?>
                            
                              <tr>
                                <td>{{$row['product_name']}}</td>
                                <td>{{$row['no_product']}}</td>
                                <td>{{$row['product_price']}}</td>
                                <td>{{$row['total_price']}}</td>
                              </tr>
                              <?php 
                                  $total=$total+$row['total_price'];
                              }
                              ?>
                              <tr>
                                <td style="border: 1px solid #fff;"></td>
                                <td style="border-bottom: 1px solid #fff;"></td>
                                <th>Total</th>
                                <td>{{$total}}</td>
                              </tr>
                         </tbody>
                    </table>
                </div>
            </div>
        <div class="col-0 col-sm-0 col-md-2"></div>
    </div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
</body>
</html>
