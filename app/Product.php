<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use League\Flysystem\Exception;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product';
    protected $appends = ['hashid'];

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'image', 'created_at', 'updated_at'];

    /**
     * The detail_value that belong to the product.
     */
    public function productDetailValue()
    {
        return $this->belongsToMany('App\ProductDetailValue','cross_product_detail_value','product_id','detail_value_id');
    }
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }
    /**
     * The price that belong to the product.
     */
    public function price()
    {
        return $this->belongsToMany('App\Price','cross_product_price','product_id','price_id');
    }

    public static function create(array $attributes = [])
    {

        $product = new Product();
        foreach($attributes as $key => $value){
            if(in_array($key,$product->fillable)){
                $product->$key = $value;
            }
        }
        /* @var $file \Illuminate\Http\UploadedFile */
        $file = $attributes['image'];
        $photoName = uniqid();
        $file->move(base_path() . '/public/images/product' , $photoName .'.' . $file->getClientOriginalExtension() );
        $product->image = $photoName .'.' . $file->getClientOriginalExtension();
        $product->save();
        return $product;
    }
}
