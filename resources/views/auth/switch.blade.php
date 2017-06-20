@extends('layouts.tenant')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sign In</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('signIn.check') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                            <div class="col-md-offset-2 col-md-8">
                                <div class="input-group input-group-lg">
                                    <input id="domain" type="text" class="form-control text-right" name="domain" value="{{ old('domain') }}" autofocus>
                                    <span class="input-group-addon">.{{ config('app.url') }}</span>
                                </div>

                                @if ($errors->has('domain'))
                                    <span class="help-block text-center">
                                        <strong>{{ $errors->first('domain') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-8 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>

                                <a class="btn btn-default btn-lg" href="{{ route('register') }}">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
