@extends('layouts.app')
@section('content')
    <div class="col-xs-12">
        <div class="col-xs-6">
            <div>نام محصول: {!! $product->title !!}</div>
            <div>شرح محصول : {!! $product->description !!}</div>


                    @foreach($productDetailWithValues as $key=>$value)
                        <div>{!!  $value['detail']->title !!} : {!!  $value['detailValue']->value !!}</div>
                    @endforeach

            </table>
        </div>
        <div class="col-xs-6 height-m">
            <img src="/images/product/<?=$product->image?>" alt="test">
        </div>
    </div>

@endsection