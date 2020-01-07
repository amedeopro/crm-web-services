<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Work extends Model
{
    use Notifiable;

    protected $fillable = ['work_type','dead_line','finished','information'];
    protected $table = 'works';
  
    public function customers(){
        return $this->belongsToMany(Customer::class)->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
