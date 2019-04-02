<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Image extends Model {

		protected $guarded = ['id', 'created_at', 'updated_at'];
		protected $hidden = ['id', 'apartment_id', 'created_at', 'updated_at'];

		public function apartment() {
			return $this->belongsTo(Apartment::class);
		}
	}
