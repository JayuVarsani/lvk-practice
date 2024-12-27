@extends('admin.layout.auth')
@section('title')
    Forgot Password
@endsection
@section('content')
    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post"
                              action="{{ route('admin.password.email') }}">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">
                                    <!-- {{__('admin.forgot-password.title')}} -->
                                    Forgot Password
                                </h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{__('admin.forgot-password.sub_title',['site_name'=>config('app.name')])}}
                                </div>
                                <div class="my-5">
                                    <x-alert/>
                                </div>
                            </div>
                            <div class="fv-row mb-4">
                                <input type="text" placeholder="Email" name="email" autocomplete="off"
                                       class="form-control bg-transparent"/>
                                <x-error name="email"/>
                            </div>
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                                    <span class="indicator-label">{{__('app.panel.submit')}}</span>
                                </button>
                                <a href="{{ route('login') }}"
                                   class="btn btn-light">{{__('app.panel.cancel')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(() => {
            $('#kt_sign_in_form').validate({
                rules: {
                    email: {required: true, email: true},
                },
                messages: {
                    email: {required: 'Please enter email'},
                }
            });

        })
    </script>
@endsection
