<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public $timestamps = true;
    protected $guarded = [];
    protected $primaryKey = 'product_id';
}
