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
                        <h2>{{ __(trans('str.resetPass')) }}</h2>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input placeholder="{{ __('E-Mail') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="container form-group row mb-0">
                                <button class="btn btn-primary col-md-6 col-md-offset-3 col-xs-12" type="submit">{{ __(trans('str.invia')) }}</button>
                            </div>
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
