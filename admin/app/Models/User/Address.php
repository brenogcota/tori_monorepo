<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Address extends Model 
{
   
    protected $table = "addresses";

    protected $fillable = [ 'zip_code' , 'street', 'district', 'number', 'complement', 'state', 'city' ];


    public $timestamps = false;

    protected $hidden = ['user_id'];


}
