<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ProductDetailController extends Controller
{
    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        $valid =  Validator::make($data, [
            'title' => 'required',
        ]);
        $valid->getMessageBag()->add('title','title must have at least 10 character');
        return $valid;
    }

    /**
     * Create a new detail for produts
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * desc
     */
    public function registerNewDetail(Request $request)
    {

        $this->validator($request->all())->validate();
        $product = $this->create($request->all());
        if(get_class($product) == 'App\ProductDetail'){
            $request->session()->flash('alert-success', 'new value added successfully');
            return redirect('/detail');
        }else{
            $request->session()->flash('alert-danger', 'an error occurred !');
            return  redirect('/detail');
        }
    }

    public function permission()
    {
        if(Auth::user()){
            if(Auth::user()->isAdmin()){
                return view('productDetail/productDetail');
            }
        }
        return redirect('/');

    }

    /**
     * Create a new ProductِDetail instance after a valid registration.
     *
     * @param  array  $data
     * @return ProductِDetail
     */
    protected function create(array $data)
    {
        return  ProductDetail::create([
            'title' => $data['title'],
        ]);

    }

    /**
     * Finds the value of each details
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findEachDetail(Request $request)
    {
        $post_requests = $request->all();
        if(isset($post_requests['detail'])){
            $product_detail = ProductDetail::find((int)$post_requests['detail']);
            if($product_detail && get_class($product_detail) == 'App\ProductDetail'){
                $details_value = $product_detail->productDetailValue()->get();
               return response()->json(['detailsValue'=>$details_value]);
            }
        }
        return response()->json(['detailsValue'=>array()]);
    }

}
