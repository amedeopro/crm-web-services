<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerWork extends Model
{
    protected $fillable = ['customer_id','user_id', 'work_id'];
    protected $table = 'customer_works';

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
