@extends('admin.layout.app')
@section('content')
    <div>
        <x-alert/>
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Update Profile</h3>
                </div>
            </div>
            <form class="form" method="post" action="{{route('admin.profile.update-profile')}}"
                  enctype="multipart/form-data" id="profile_form">
                @csrf
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6"
                               for="thumb_image">{{__('admin.input.profile_image')}}</label>
                        <div class="col-lg-9 fv-row">
                            <input type="file"
                                   id="thumb_image" class="form-control form-control-lg"
                                   name="image"
                                   accept="image/*"/>
                            <x-error name="image"/>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="name">{{__('admin.input.name')}}</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text"
                                   name="name" id="name" class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter name"
                            value="{{$admin->name}}">
                            <x-error name="name"/>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="email">{{__('admin.input.email')}}</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text"
                                   name="email" id="email" class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter email"
                                   value="{{$admin->email}}">
                            <x-error name="email"/>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{route('admin.dashboard')}}"
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
            $('#profile_form').validate({
                rules: {
                    name: {required: true},
                    email: {required: true, email: true}
                },
                messages: {
                    email: {required: 'Please enter email'},
                }
            })

        });
        $(function () {
            $("#profile_form").submit(function () {
                $('#loader').removeClass("d-none");
            });
        });
    </script>
@endsection
