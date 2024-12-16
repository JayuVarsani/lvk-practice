@extends('admin.layout.auth')
@section('content')
    <div>
        Hello From Dashboard123
    </div>
    <x-alert/>
    <form action="{{ route('admin.logout') }}" method="post">
        @csrf
    <button type="submit" class="btn btn-primary auth_btn w-100 mb-3">Logout</button>
    </form>
@endsection
