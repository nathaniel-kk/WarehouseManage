<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryRecords extends Model
{
    protected $table = "Inventory_records";
    public $timestamps = true;
    protected $guarded = [];
    protected $primaryKey = 'inventory_id';
}
