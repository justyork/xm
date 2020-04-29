<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 27.04.2020
 */
?>
@extends('layout')

@section('content')



<form action="{{ route('validate') }}" method="post">
    @csrf
    <h1>Search tickers</h1>

    <div class="row">
        <div class="col">
            <x-field field="ticker" label="Ticker" type="input" :value="old('ticker')"/>
        </div>
        <div class="col">
            <x-field field="date_from" label="Date from" type="date"  :value="old('date_from')" />
        </div>
        <div class="col">
            <x-field field="date_to" label="Date to" type="date"  :value="old('date_to')" />
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Send</button>
        @if($table)
            <a href="{{ route('home') }}" class="btn btn-warning">Clear</a>
        @endif
    </div>

    @if($table)
        <div class="form-group row">
            <div class="col-3">
                <x-field field="email" type="input" :label="false" />
            </div>
            <div class="col-3">
                <button class="btn btn-secondary" name="send-email">Send an Email</button>
            </div>
        </div>
    @endif
</form>

@if($chart)
    <x-chart :data="$chart"/>
@endif

@if($table)
    <x-table :items="$table" />
@endif

@endsection
