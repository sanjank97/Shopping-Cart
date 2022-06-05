<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyBill</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align:center;
    padding:7px;
    font-size:12px;
    }
  
</style>
</head>
<body>
   <div >
    <?php
        foreach($rows as $row)
        $total=0;    

    ?>
   <table border="1" style="margin:0 auto;"> 
        <tr>
            <th colspan="4"> Transection details</th>
        </tr>
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
     </table>
     </div>
</body>
</html>