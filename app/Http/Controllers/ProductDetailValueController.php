<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use App\ProductDetailValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ProductDetailValueController extends Controller
{
    public function permission()
    {
        if(Auth::user()){
            if(Auth::user()->isAdmin()){
                $all_product_detail = ProductDetail::all();
                return view('productDetailValue/productDetailValue',array('all_product_details'=>$all_product_detail));
            }
        }
        return redirect('/');

    }

    protected function validator(array $data)
    {
        $valid =  Validator::make($data, [
            'value' => 'required',
        ]);
        $valid->getMessageBag()->add('value','please enter value');
        return $valid;
    }

    /**
     * Create a new ProductِDetail instance after a valid registration.
     *
     * @param  array  $data
     * @return ProductِDetail
     */
    protected function create(array $data)
    {
        return  ProductDetailValue::create([
            'value' => $data['value'],
        ]);

    }

    /**
     * Creates a new value
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerNewValue(Request $request)
    {
        $all_request = $request->all();
        $this->validator($all_request)->validate();
        $product_detail_value = $this->create($all_request);
        if(get_class($product_detail_value) == 'App\ProductDetailValue'){
             $specific_product_detail = ProductDetail::find((int)$request['detail']);
             if($specific_product_detail && get_class($specific_product_detail) == 'App\ProductDetail'){
                $product_detail_value->productsDetail()->sync(array((int)$request['detail']),0);
                $request->session()->flash('alert-success', 'new value added successfully');
                return redirect('/detailValue');
             }
        }
        $request->session()->flash('alert-danger', 'an error occurred !');
        return  redirect('/detailValue');

    }


}
