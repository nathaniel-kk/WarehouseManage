<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoInformation extends Model
{
    protected $table = "cargo_information";
    public $timestamps = true;
    protected $guarded = [];
    protected $primaryKey = 'cargo_id';
}
