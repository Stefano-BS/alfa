@extends('layout.master')

@section('titolo','Alfa')

@section('barraAccesso')
<?php
    require_once('barra.php');
    barra("class='active'");
?>
@endsection

@section('corpo')
<br>
<div class="container">
    <div class="row align-middle">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h2>@lang('str.accedi')</h2>
                        <hr>
                        <em><h4 class="text-center">@lang('str.nonSeiRegistrato') <a href="{{ route('register') }}">@lang('str.registrati')</a></em></h4>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-10 col-md-offset-1">
                                    <input placeholder="{{ __('E-Mail') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10 col-md-offset-1">
                                    <input placeholder="{{ __('E-Password') }}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                </div>
                            </div>
                            
                            <div class="container form-group row">
                                <button class="col-md-3 col-md-offset-2 col-xs-12 btn btn-primary" type="submit">{{ __(trans('str.accedi')) }}</button>
                                <div class="col-md-0 col-xs-12"> </div>
                                @if (Route::has('password.request'))
                                    <a class="col-md-3 col-md-offset-2 col-xs-12 btn btn-default" href="{{ route('password.request') }}">{{ __(trans('str.passDimenticata')) }}</a>
                                @endif
                            </div>
                            @error('email')
                                <div class="alert alert-danger alert-dismissable text-center fade in" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $message }}</div>
                            @enderror
                            @error('password')
                                <div class="alert alert-danger alert-dismissable text-center fade in" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
