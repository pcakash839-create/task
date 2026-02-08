<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItemModel extends Model
{
    //
    protected $table = "cart_item";
    protected $primaryKey = "id";
    protected $guarded = [];
}
