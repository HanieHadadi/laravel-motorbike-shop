@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading">درج یک محصول</div>
                    <div class="panel-body">
                        <form  id="ss" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/insert') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                                <div class="col-md-8 col-lg-offset-1">
                                    <input id="title" type="text" class="form-control"  value="{{ old('title') }}" name="title" required autofocus>

                                @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="name" class="col-md-2 control-label"><span class="red-star">*</span>عنوان</label>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                <div class="col-md-8 col-lg-offset-1">
                                    <textarea  class="form-control" name="description"  required>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="description" class="col-md-2 control-label"><span class="red-star">*</span>توضیحات</label>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

                                <div class="col-md-8 col-lg-offset-1">
                                    <input id="image" type="file" class="form-control" name="image" required>

                                @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="password" class="col-md-2 control-label"><span class="red-star">*</span>عکس</label>
                            </div>
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                 <div class="col-md-8 col-lg-offset-1">
                                    <input id="price" type="number" class="form-control" value="{{ old('price') }}" name="price" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="password" class="col-md-2 control-label"><span class="red-star">*</span>قیمت</label>
                            </div>
                            <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                                <div class="col-md-8 col-lg-offset-1">
                                    <input id="discount" type="number" class="form-control"  value="{{ old('discount') }}" name="discount" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="password" class="col-md-2 control-label"><span class="red-star">*</span>تخفیف</label>
                            </div>
                            <div class="form-group">

                                <label class="col-lg-offset-9 add-select btn btn-link col-md-2 control-label">افزودن ویژگی</label>
                            </div>
                           <div class="hide select-form-op">
                            <div class="form-group ">

                                <div class="col-md-8 col-lg-offset-1">
                                    <select name="detail[]" class="details_value">
                                        <option value="0">انتخاب کنید</option>
                                        @foreach($all_product_details as $key_p => $detail)
                                            <option value="{{$detail->id}}">{{$detail->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="password" class="col-md-2 control-label">ویژگی</label>
                            </div>

                            <div class="form-group hide ">
                                <div class="col-md-8 col-lg-offset-1">
                                    <select name="value[]" class="value_container" >

                                    </select>
                                </div>
                                <label for="password" class="col-md-2 control-label">صفت</label>
                            </div>

                           </div>
                           <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" id="register-product" class="btn btn-primary">
                                        ثبت
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('product/_menu')
        </div>
    </div>
@endsection
