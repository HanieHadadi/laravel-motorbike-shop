@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
             <div class="col-md-9 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">درج یک ویژگی</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"  action="{{ url('/detail') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                                    <div class="col-md-8 col-lg-offset-1">
                                        <input id="title" type="text" class="form-control"  name="title" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <label for="name" class="col-md-2 control-label">عنوان</label>
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
