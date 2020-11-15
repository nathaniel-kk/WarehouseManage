<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipentMassage extends Model
{
    protected $table = "shipment_massage";
    public $timestamps = true;
    protected $guarded = [];
    protected $primaryKey = 'shipment_id';
}
