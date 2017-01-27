<?php

namespace App\Http\Controllers;

use App\Price;
use App\ProductDetail;
use App\ProductDetailValue;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

class ProductController extends Controller
{

    /**
     * Root of website
     * 1) fetch 6 product per page
     * 2)fetch existed details for all products
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function index()
    {

    	$all_products = Product::paginate(6);
    	$product_details =  ProductDetail::has('productDetailValue')->get();
    	$details = array();
    	foreach ($product_details as $key=>$value){
            $details[$key] = $value;
            $details[$key]['values'] = $value->productDetailValue()->get();
        }
    	$product_data = array();
    	$product_data['allProduct'] = $all_products;
    	$product_data['details'] = $details;
    	$product_data['getArray'] = array();
            
    	return view('product/product',$product_data);
    }

    /**
     * Create a new Product instance after a valid registration.
     *
     * @param  array  $data
     * @return Product
     * description:
     *
     */
    protected function create(array $data)
    {


        return  Product::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
        ]);

    }

    /**
     * Create new product this validator checked all the parameter to be valid
     *
     * @param array $data
     * @return mixed
     *
     */
    protected function validator(array $data)
    {
        $valid =  Validator::make($data, [
            'title' => 'required|min:10',
            'description' => 'required|min:30',
            'image' => 'required',
        ]);
        $valid->getMessageBag()->add('title','title must have at least 10 character');
        $valid->getMessageBag()->add('description','title must have at least 30 character');
        $valid->getMessageBag()->add('image','plz upload an image');
        return $valid;
    }

    /**
     * Creates a product and assigns a value to it
     *
     * @param Product $product
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected  function addPriceToProduct(Product $product,Request $request){
        $requests = $request->all();
        $price = 0;
        $discount = 0;
        if(isset($requests['discount'])){
            $discount = $request['discount'];
        }
        if(isset($requests['price'])){
            $price = $requests['price'];
        }
        $price = Price::create(array('real_price'=>$price,'discount'=>$discount));
        if($price && get_class($price) == 'App\Price') {
            return  $product->price()->sync(array($price->id), 0);
        }else{
            $request->session()->flash('alert-success', 'product was successfuly added but some Price not add!');
            return redirect('/');
        }
    }

    /**
     * Create a new product and assign details value to it
     *
     * @param Product $product
     * @param Request $request
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function addValueToProduct(Product $product,Request $request){
        $requests = $request->all();
        $has_problem = 0;
        foreach ($requests['value'] as $key=>$val){
            $product_detail_value = ProductDetailValue::find($val)->get();
            if($product_detail_value && count($product_detail_value) != 0){

                 $product->productDetailValue()->sync(array($val), 0);
            }else{
                $has_problem = 1;
            }
        }
        if($has_problem){
            $request->session()->flash('alert-success', 'product was successfully added but some features has not been added!');

            return redirect('/');
        }
        return true;
    }

    /**
     * Registers a new product to database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerNewProduct(Request $request)
    {

        $requests = $request->all();
        $this->validator($requests)->validate();
        $product = $this->create($requests);
        if(get_class($product) == 'App\Product'){
            if(isset($requests['value'])){
               $this->addValueToProduct($product, $request);
            }
            if(isset($requests['price'])){
                 $this->addPriceToProduct($product, $request);
            }
            $request->session()->flash('alert-success', 'product was successfully added!');
            return redirect('/');
        }else{
            $request->session()->flash('alert-error', 'error occurred!');
           return  redirect('/insert');
        }
    }

    /**
     * Check login user can see admin panel ( has admin permission to see )
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function permission()
    {
        if(Auth::user()){
            if(Auth::user()->isAdmin()){
                $all_product_detail = ProductDetail::has('productDetailValue')->get();
                $first_detail = $all_product_detail->first();
                $all_detail_values = array();
                if(isset($first_detail)){
                     $all_detail_values = $first_detail->productDetailValue()->get();
                }
                return view('product/insert',array('all_product_details'=>$all_product_detail,'all_detail_values'=>$all_detail_values));
            }
        }
        return redirect('/');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function search(Request $request){
        $product_details =  ProductDetail::has('productDetailValue')->get();
        $details = array();
        $sort = 'ASC';
        $result = array();
        foreach ($product_details as $key=>$value){
            $details[$key] = $value;
            $details[$key]['values'] = $value->productDetailValue()->get();
        }
        $requests_params = $request->all();
        if(sizeof($requests_params) == 0){
            $result = Product::paginate(6);
            $result_array = array();
            $result_array['allProduct'] = $result;
            $result_array['getArray'] = $requests_params;
            $result_array['details'] = $details;
            return view('product/product',$result_array);
        }
        if($request->has('sort')){
            $sort = $requests_params['sort'];
        }

        $value_key_array = array();
        foreach ($requests_params as $key=>$value){

            if(strpos($key,'value-')!== false){
                 $detail_id =  explode('-',$key)[1];
                $product_detail_value = ProductDetailValue::find($detail_id)->get();
                if($product_detail_value && count($product_detail_value) != 0){
                    $value_key_array[] = $detail_id;
                }
            }
        }

        if(sizeof($value_key_array) != 0  ){
                $result = Product::whereHas('productDetailValue', function ($query)  use ($value_key_array) {
                                             $query->whereIn('product_detail_value.id', $value_key_array);
                                        });
                

            if($request->has('filter')) {
                if($requests_params['filter'] == 'time'){
                    $result->orderBy('created_at',  $sort);
                }

                if ($requests_params['filter'] =='price') {

                    $result->select(\DB::raw('product.*')) ->join('cross_product_price','product.id','=','cross_product_price.product_id')
                            ->join('price','cross_product_price.price_id','=','price.id')
                            ->orderBy('real_price',$sort);
                }

            }

            $result =  $result;
        }else{
            if($request->has('filter')) {
                if($requests_params['filter'] == 'time'){
                    $result = Product::orderBy('created_at',  $sort);
                }

                if ($requests_params['filter'] =='price') {
                    $result = Product::select(\DB::raw('product.*'))
                                    ->join('cross_product_price','product.id','=','cross_product_price.product_id')
                                    ->join('price','cross_product_price.price_id','=','price.id')
                                    ->orderBy('real_price',$sort);
                }

            }
        }
        if(sizeof($result) != 0){

            $result = $result->paginate(6)->appends($request->except('page'));
        }else{
            $result = Product::paginate(6);
        }

        $result_array = array();
        $result_array['allProduct'] = $result;
        $result_array['getArray'] = $requests_params;
        $result_array['details'] = $details;
        return view('product/product',$result_array);
    }

    /**
     * Returns data of that product if that doesn't exist show 404 page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){

        $id = Hashids::decode($id);
        $product = Product::find($id)->first();
        if(sizeof($product) != 0) {
            $product_detail = $product->productDetailValue()->get();
            $product_detail_with_values = array();
            $counter = 0;
            foreach ($product_detail as $key => $value) {
                $product_detail_with_values[$counter]['detail'] = ProductDetail::whereHas(
                    'productDetailValue', function ($q) use ($value) {
                    $q->where('product_detail_value.id', $value->id);
                }
                )->get()->first();
                $product_detail_with_values[$counter]['detailValue'] = $value;
                $counter++;
            }
            return view('product/show', array('product' => $product, 'productDetailWithValues' => $product_detail_with_values));
        }else{
            abort(404, 'The resource you are looking for could not be found');

        }
    }

}
