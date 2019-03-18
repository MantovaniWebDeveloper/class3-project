<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	use Cviebrock\EloquentSluggable\Sluggable;
	
	class Apartment extends Model {
		use Sluggable;
		
		protected $guarded = ['id', 'created_at', 'updated_at'];
		
		/**
		 * Return the sluggable configuration array for this model.
		 *
		 * @return array
		 */
		public function sluggable() {
			return [
			  'slug' => [
				'source' => 'title'
			  ]
			];
		}
	}
