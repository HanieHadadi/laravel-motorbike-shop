@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">درج یک صفت</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/detailValue') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                                    <div class="col-md-8 col-lg-offset-1">
                                        <select name="detail" id="">
                                            @foreach($all_product_details as $key_p => $detail_val)
                                                <option value="{{$detail_val->id}}">{{$detail_val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="name" class="col-md-2 control-label">ویژگی</label>
                                </div>
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                                    <div class="col-md-8 col-lg-offset-1">
                                        <input id="value" type="text" class="form-control"  value="{{ old('value') }}" name="value" required autofocus>

                                        @if ($errors->has('value'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <label for="name" class="col-md-2 control-label">مقدار</label>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">
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
