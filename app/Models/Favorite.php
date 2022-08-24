<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Favorite extends Model {

protected $table    = 'favorites';
protected $fillable = [
		'id',
		'admin_id',
        'products_id',
        'user_id',
		'created_at',
		'updated_at',
	];

	/**
    * user_id relation method
    * @param void
    * @return object data
    */
   public function user_id(){
      return $this->hasOne(\App\Models\User::class,'id','user_id');
   }

	/**
    * products relation method
    * @param void
    * @return object data
    */
   public function products(){
      return $this->hasMany(\App\Models\product::class,'id','products_id');
   }

 	/**
    * Static Boot method to delete or update or sort Data
    * @param void
    * @return void
    */
   protected static function boot() {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
         static::deleting(function($favorite) {
			//$favorite->user_id()->delete();
			//$favorite->user_id()->delete();
         });
   }
		
}
