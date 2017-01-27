<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $value
 * @property string $created_at
 * @property string $updated_at
 */
class ProductDetailValue extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product_detail_value';

    /**
     * @var array
     */
    protected $fillable = ['value', 'created_at', 'updated_at'];

    /**
     * The productsDetail that belong to the value.
     */
    public function productsDetail()
    {
        return $this->belongsToMany('App\ProductDetailValue','cross_detail_value','detail_value_id','detail_id');
    }

    /**
     * The products that belong to the value.
     */
    public function products()
    {
        return $this->belongsToMany('App\ProductDetailValue','cross_product_detail_value','detail_value_id','product_id');
    }
}
