<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'website', 'address', 'logo'
      ];

   public function employees()
   {
        return $this->hasMany(Employee::class);
   }
}
