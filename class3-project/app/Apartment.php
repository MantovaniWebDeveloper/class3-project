<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Cviebrock\EloquentSluggable\Sluggable;

	class Apartment extends Model {
		use Sluggable;

		protected $guarded = ['id', 'created_at', 'updated_at'];
		protected $hidden = ['id', 'user_id', 'end_promo', 'created_at', 'updated_at'];
		//		protected $visible = ['price', 'distance'];
		protected $with = array('services', 'images');
		//il with serve per la serializzazione, ad esempio nel ritornare il json di un elemento, se lo stesso ha relazioni include anche quelle indicate qui

		public function services() {
			return $this->belongsToMany(Service::class)->withTimestamps();
		}

		public function images() {
			return $this->hasMany(Image::class);
		}

		public function user(){
			return $this->belongsTo(User::class);
		}

		public function messages(){
			return $this->hasMany(Message::class);
		}
		public function visits(){
			return $this->hasMany(Visit::class);
		}
		

		public function visits(){
			return $this->hasMany(Visit::class);
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

		public function scopeFindInRange($query, $radius, $latitude, $longitude, $orderByDistance) {
			$haversine = "(6371 * acos(cos(radians($latitude))
                     * cos(radians(latitude))
                     * cos(radians(longitude)
                     - radians($longitude))
                     + sin(radians($latitude))
                     * sin(radians(latitude))))";
			$query
			  ->select('*')
			  ->selectRaw("{$haversine} AS distance")
			  ->whereRaw("{$haversine} <= ?", [$radius]);
			if ($orderByDistance) {
				$query->orderByRaw('distance');
			}
			return $query;
		}

		public function scopeIsShowed($query) {
			return $query->where('is_showed', 1);
		}
	}
