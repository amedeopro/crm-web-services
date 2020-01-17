<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomersPassword extends Model
{
  protected $fillable = ['customer_id', 'url','username','password','host','informations','type'];
  
        public function customers()
    {
        return $this->belongsTo(Customer::class)->withTimestamps();
    }
}
