<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Service extends Model {
		
		protected $fillable = ['name'];
		protected $hidden = ['pivot', 'created_at', 'updated_at'];
		
		public function apartments(){
			return $this->belongsToMany(Apartment::class)->withTimestamps();
		}
	}
