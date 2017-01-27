<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $real_price
 * @property integer $discount
 * @property string $created_at
 * @property string $updated_at
 */
class Price extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'price';

    /**
     * @var array
     */
    protected $fillable = ['real_price', 'discount', 'created_at', 'updated_at'];

    /**
     * The product that belong to the price.
     */
    public function product()
    {
        return $this->belongsToMany('App\Product','cross_product_price','price_id','product_id');
    }
}
