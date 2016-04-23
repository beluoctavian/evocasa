<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model {

	protected $guarded = [];

    protected $table = 'terrain';

    protected $fillable = [
      'total_area',
      'street_opening',
      'depth',
      'access_width',
      'advert_id',
    ];

    public static $properties = [
      'total_area',
      'street_opening',
      'depth',
      'access_width',
      'advert_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }

    /**
     * @param array $parameters
     * @param \App\Advert $advert
     * @return static
     */
    public static function createFromArray(array $parameters, Advert $advert)
    {
        $valid_parameters = [
          'advert_id' => $advert->id,
        ];
        foreach ($parameters as $key => $value) {
            if (in_array($key, self::$properties)) {
                $valid_parameters[$key] = $value;
            }
        }
        return self::create($valid_parameters);
    }

}
