<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	use Cviebrock\EloquentSluggable\Sluggable;
	
	class Apartment extends Model {
		use Sluggable;
		
		protected $guarded = ['id', 'created_at', 'updated_at'];
		
		public function services(){
			return $this->belongsToMany(Service::class)->withTimestamps();
		}
		
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
		
		public function scopeFindInRange($query, $radius, $latitude, $longitude) {
			$haversine = "(6371 * acos(cos(radians($latitude))
                     * cos(radians(latitude))
                     * cos(radians(longitude)
                     - radians($longitude))
                     + sin(radians($latitude))
                     * sin(radians(latitude))))";
			return $query
			  ->select('*')
			  ->selectRaw("{$haversine} AS distance")
			  ->whereRaw("{$haversine} <= ?", [$radius])
			  ->orderByRaw('distance');
		}
	}
