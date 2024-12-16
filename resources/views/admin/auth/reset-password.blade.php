@extends('admin.layout.auth')
@section('title')
    Reset Password
@endsection
@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                    <x-alert/>
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-500px p-10">
                            <h1 class="text-center mb-7">Reset Password</h1>
                            <form method="POST" action="{{ route('password.update') }}" id="main_form">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="mb-sm-7 mb-4">
                                    <label for="email" class="form-label">
                                        Email :<span class="required"></span>
                                    </label>
                                    <input id="email" class="form-control form-control-solid" type="email"
                                           value="{{ old('email', $request->email) }}"
                                           required autofocus name="email" autocomplete="off"
                                           minlength="1"
                                           maxlength="255"
                                           placeholder="{{__('messages.web.email')}}"/>
                                    <div class="invalid-feedback">
                                        <x-error name="email"/>
                                    </div>
                                </div>
                                <div class="mb-sm-7 mb-4">
                                    <label class="form-label"
                                           for="password">Password</label>
                                    <div class="mb-3 position-relative">
                                        <input id="password" class="form-control form-control-solid"
                                               type="password"
                                               minlength="5"
                                               maxlength="255"
                                               name="password"
                                               required autocomplete="off"/>
                                    </div>
                                    <div class="invalid-feedback">
                                        <x-error name="password"/>
                                    </div>
                                </div>
                                <div class="fv-row mb-5">
                                    <label class="form-label "
                                           for="password_confirmation">Confirm Password</label>
                                    <input class="form-control  form-control-solid" type="password"
                                           minlength="1"
                                           maxlength="255"
                                           id="password_confirmation" name="password_confirmation" autocomplete="off"/>
                                    <div class="invalid-feedback">
                                        <x-error name="password_confirmation"/>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">{{ __('Reset Password') }}</span>
                                    </button>
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
            // console.log('one')
            $('#main_form').validate({
                rules: {
                    email: {required: true, email: true},
                    password: {required: true},
                    password_confirmation:{required:true,equalTo: "#password"}
                },
                messages: {
                    email: {required: 'Please enter email'},
                    password: {required: 'Please enter password'},
                }
            });

        })
    </script>
@endsection
