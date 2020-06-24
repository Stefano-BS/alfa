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
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h2>@lang('str.registrati')</h2>
                        <hr>
                        <em><h4 class="text-center">@lang('str.seiGiaRegistrato') <a href="{{ route('login') }}">@lang('str.accedi')</a></em></h4>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __(trans('str.nome')) }}</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __(trans('str.confermaPass')) }}</label>
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="container form-group row">
                                <button type="submit" class="col-md-8 col-md-offset-2 col-xs-12 btn btn-primary">{{ __(trans('str.registrati')) }}</button>
                            </div>
                            @error('name')
                                <div class="alert alert-danger alert-dismissable text-center fade in" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $message }}</div>
                            @enderror
                            @error('password')
                                <div class="alert alert-danger alert-dismissable text-center fade in" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $message }}</div>
                            @enderror
                            @error('email')
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
