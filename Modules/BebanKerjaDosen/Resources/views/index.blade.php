{{-- @extends('bebankerjadosen::layouts.master') --}}
@extends('backEnd.master')

@section('mainContent')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('bebankerjadosen.name') !!}
    </p>
@endsection
