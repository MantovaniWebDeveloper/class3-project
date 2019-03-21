<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	use Cviebrock\EloquentSluggable\Sluggable;
	
	class Apartment extends Model {
		use Sluggable;
		
		protected $guarded = ['id', 'created_at', 'updated_at'];
		protected $hidden = ['id', 'user_id', 'end_promo', 'created_at', 'updated_at'];
		protected $with = array('services', 'images');
		
		public function services() {
			return $this->belongsToMany(Service::class)->withTimestamps();
		}
		
		public function images() {
			return $this->hasMany(Image::class);
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
		
		public function scopeIsShowed($query) {
			return $query->where('is_showed', 1);
		}
	}
