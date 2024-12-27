@extends('admin.layout.app')
@section('content')
    <div x-data="filter">
        <x-alert/>
        <x-loader target="none"/>
{{--        <div class="card">--}}
            <h1>Dashboard</h1>
            <div class="card-body pt-0">
            </div>
{{--        </div>--}}
    </div>
@endsection
