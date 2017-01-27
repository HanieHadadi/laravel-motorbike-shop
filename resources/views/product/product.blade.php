@extends('layouts.app')


@section('content')
      <main>
            <div class="container-fluid no-pad" id="">
                <div class="container">
                    <div class="row">
                        <form action="/search" method="get" class="filter">
                        <div class="col-md-3 col-sm-4 col-xs-12 pull-right">
                            <div class="right-cat">
                                <div class="row" id="switch-box">
                                    <div class="col-xs-12">
                                        <h4>مرتب سازی بر اساس</h4>
                                    </div>
                                    <div class="col-xs-12">
                                        <select  class="col-xs-12 filters-options" name="filter" id="">
                                            <option @if(in_array('time',$getArray)) selected @endif value="time">جدیدترین</option>
                                            <option @if(in_array('price',$getArray)) selected @endif value="price">قیمت</option>
                                        </select>
                                        <select  class="col-xs-12 filters-options top-margin"name="sort" id="">
                                            <option  @if(in_array('ASC',$getArray)) selected @endif value="ASC">صعودی</option>
                                            <option  @if(in_array('DESC',$getArray)) selected @endif value="DESC">نزولی</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-xs-12 no-pad btn-border"></div>
                                 
                                <div class="row" id="sarfasl-checkbox">

                                    @foreach($details as $detail_key=>$detail_value)
                                        <div class="col-xs-12">
                                            <h4>{!! $detail_value->title !!}</h4>
                                        </div>

                                        <div class="col-xs-12">

                                              @foreach($detail_value['values'] as $detail_value_k =>$detail_value_val)
                                                 <div>
                                                    <label><input @if(key_exists('value-'.$detail_value_val->id,$getArray)) checked @endif type="checkbox" name="value-{!! $detail_value_val->id !!}" class="metadata-on" id="{!! $detail_value_val->id !!}" value="">{!! $detail_value_val->value !!}</label>
                                                </div>
                                              @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                </div>
                        </div>
                        </form>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="row package-display" style="display: block;">
                                @foreach($allProduct as $key=>$product)
                                <div class="col-md-4 col-xs-12 col-sm-6 pull-right">
                                    <a href="{{ url('/show',$product->hashid) }}">
                                        <div class="img-box">
                                            <div class="col-xs-12 no-pad">
                                                <div class="box-img" style="background-image:url(/images/product/<?=$product->image?>)">

                                                </div>
                                            </div>
                                            <div class="col-xs-12 no-pad pull-right"><p>{!!$product->title!!}</p></div>

                                            <div class="col-xs-8 no-pad">
                                                @if(is_null($product->price()->get()->first()['real_price']))
                                                    <p class="orange">رایگان</p></div></div></a>
                                                @else
                                                    <p class="orange"><?=number_format($product->price()->get()->first()['real_price'])?> تومان </p></div></div></a>
                                                @endif

                                </div>
                                @endforeach
                            </div>
                            <div class="col-xs-12 no-pad btn-border"></div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <?=$allProduct?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection