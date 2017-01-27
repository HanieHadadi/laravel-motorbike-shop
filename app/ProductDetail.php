<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class ProductDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product_detail';

    /**
     * @var array
     */
    protected $fillable = ['title', 'created_at', 'updated_at'];

    /**
     * The value that belong to the detail.
     */
    public function productDetailValue()
    {
        return $this->belongsToMany('App\ProductDetailValue','cross_detail_value','detail_id','detail_value_id');
    }
}
