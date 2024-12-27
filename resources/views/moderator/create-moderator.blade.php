@extends('admin.layout.app')
@section('content')
    <div>
        <x-alert/>
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">{{$title}}</h3>
                </div>
            </div>
            <form class="form" method="post" action="{{route('admin.moderator.store')}}"
                  enctype="multipart/form-data" id="create_form">
                @csrf
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6"
                               for="thumb_image">{{__('admin.input.profile_image')}}</label>
                        <div class="col-lg-9 fv-row">
                            <input type="file"
                                   id="profileImage" class="form-control form-control-lg"
                                   accept="image/*"
                                   name="profileImage"
                                   value="{{old('profileImage')}}">
                            <x-error name="profileImage"/>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="name">Name</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" id="name"
                                   name="name"
                                   class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter name"
                                   value="{{old('name')}}">
                            <x-error name="name"/>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="email">Email</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text"
                                   name="email" id="email" class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter email"
                                   value="{{old('email')}}">
                            <x-error name="email"/>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="password">Password</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text"
                                   name="password" id="password" class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter password">
                            <x-error name="password"/>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{route('admin.moderator.index')}}"
                       class="btn btn-light btn-active-light-primary me-2">{{__('app.panel.cancel')}}</a>
                    <button type="submit" class="btn btn-primary">{{__('app.panel.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(() => {
            $('#create_form').validate({
                rules: {
                    name: {required: true},
                    email: {required: true, email: true},
                    password: {required: true}
                },
            })
        });
    </script>
@endsection
{{--        $(function () {--}}
{{--            $("#create_form").submit(function () {--}}
{{--                $('#loader').removeClass("d-none");--}}
{{--            });--}}
{{--        });--}}
