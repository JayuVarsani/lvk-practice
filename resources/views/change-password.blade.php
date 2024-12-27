@extends('admin.layout.app')
@section('content')
    <div>
        <x-alert/>
        <div class="card mb-5 mb-xl-10">
            <x-loader target="none"/>
            <div class="card-header border-0">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">{{__('admin.change-password.title')}}</h3>
                </div>
            </div>
            <form class="form" id="main_form" method="post" action="{{ route('admin.profile.change-password.post') }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="card-body border-top p-9">

                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="oldPassword">{{__('admin.input.current_password')}}</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text"
                                   name="currentPassword" id="oldPassword"
                                   class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter Current password">
                            <x-error name="currentPassword"/>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="password">{{__('admin.input.password')}}</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text"
                                   name="password" id="password" class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter password">
                            <x-error name="password"/>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6 required"
                               for="confirmPassword">{{__('admin.input.confirm_password')}}</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text"
                                   name="confirmPassword" id="confirmPassword"
                                   class="form-control form-control-lg form-control-solid"
                                   placeholder="Please enter confirm password">
                            <x-error name="confirmPassword"/>
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
            $('#main_form').validate({
                rules: {
                    currentPassword: {required: true},
                    password: {required: true},
                    confirmPassword: {required: true, equalTo: "#password"}
                }
            });
        })
        $(function () {
            $("#main_form").submit(function () {
                $('#loader').removeClass("d-none");
            });
        });
    </script>
@endsection

