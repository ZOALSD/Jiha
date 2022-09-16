<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Serviceus extends Model
{

   use SoftDeletes;
   protected $dates = ['deleted_at'];

   protected $table    = 'serviceus';
   protected $fillable = [
      'id',
      'admin_id',
      'user_id',
      'category_id',
      'available',
      'price',
      'delivery',
      'disc',
      'image',
      'active',
      'title',
      'created_at',
      'updated_at',
      'deleted_at',
   ];

   /**
    * user_id relation method
    * @param void
    * @return object data
    */
   public function user_id()
   {
      return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
   }

   /**
    * category_id relation method
    * @param void
    * @return object data
    */
   public function category_id()
   {
      return $this->hasOne(\App\Models\category::class, 'id', 'category_id');
   }

   /**
    * Static Boot method to delete or update or sort Data
    * @param void
    * @return void
    */
   protected static function boot()
   {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
      static::deleting(function ($serviceus) {
         //$serviceus->user_id()->delete();
         //$serviceus->user_id()->delete();
      });
   }
}
