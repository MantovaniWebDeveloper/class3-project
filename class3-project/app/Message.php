<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Message extends Model {
		
		protected $guarded = ['id', 'created_at', 'updated_at'];
		
		public function apartments() {
			return $this->belongsTo(Apartment::class);
		}
	}
