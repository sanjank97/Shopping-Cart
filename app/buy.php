<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buy extends Model
{
    protected $fillable=['product_id','no_product','user_id','cart_name','trans_id','cus_id','card_no'];
}
