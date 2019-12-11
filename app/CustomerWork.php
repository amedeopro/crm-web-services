<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerWork extends Model
{
    public function works(){
        return $this->belongsToMany(Work::class)->withTimestamps();
    }

    public function customers(){
        return $this->belongsToMany(Customer::class)->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
