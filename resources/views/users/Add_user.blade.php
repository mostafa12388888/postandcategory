@extends('layouts.frontend.app')
@section('css')
    <!-- Internal Nice-select css  -->
    <!-- <link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" /> -->
@section('title')
    اضافة مستخدم
@stop


@endsection

@section('body')
<div class="dashboard container">
    <!-- Main Content -->
    <div class="main-content ">
        <!-- row -->
        <div class="row">
            </br>
            <div class="dashboard container">
                <!-- Main Content -->
                <div class="main-content ">

                    <div class="col-lg-12 col-md-12">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>خطا</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                                    </div>
                                </div><br>
                                <form class="parsley-style-1" id="selectForm2" autocomplete="off" enctype="multipart/form-data" name="selectForm2"
                                    action="{{ route('users.store', 'test') }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="">

                                        <div class="row mg-b-20">
                                            <div class="parsley-input col-md-6" id="fnWrapper">
                                                <label> الاسم: <span class="tx-danger">*</span></label>
                                                <input class="form-control form-control-sm mg-b-20"
                                                    data-parsley-class-handler="#lnWrapper" name="name"
                                                    required="" type="text">
                                            </div>

                                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                                <input class="form-control form-control-sm mg-b-20"
                                                    data-parsley-class-handler="#lnWrapper" name="email"
                                                    required="" type="email">
                                            </div>
                                        </div>
                                        <div class="row mg-b-20">
                                            <div class="parsley-input col-md-6" id="fnWrapper">
                                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                                <input class="form-control form-control-sm mg-b-20"
                                                    data-parsley-class-handler="#lnWrapper" name="userName"
                                                    required="" type="text">
                                            </div>

                                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                <label> الدوله <span class="tx-danger">*</span></label>
                                                <input class="form-control form-control-sm mg-b-20"
                                                    data-parsley-class-handler="#lnWrapper" name="country"
                                                    required="" type="text">
                                            </div>
                                        </div>
                                        <div class="row mg-b-20">
                                            <div class="parsley-input col-md-6" id="fnWrapper">
                                                <label> الشارع<span class="tx-danger">*</span></label>
                                                <input class="form-control form-control-sm mg-b-20"
                                                    data-parsley-class-handler="#lnWrapper" name="street"
                                                    required="" type="text">
                                            </div>

                                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                <label> المدينه <span class="tx-danger">*</span></label>
                                                <input class="form-control form-control-sm mg-b-20"
                                                    data-parsley-class-handler="#lnWrapper" name="city"
                                                    required="" type="text">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                                            <input class="form-control form-control-sm mg-b-20"
                                                data-parsley-class-handler="#lnWrapper" name="password" required=""
                                                type="password">
                                        </div>

                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                                            <input class="form-control form-control-sm mg-b-20"
                                                data-parsley-class-handler="#lnWrapper" name="confirm-password"
                                                required="" type="password">
                                        </div>
                                    </div>

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg-6">
                                            <label class="form-label">رقم تلفون المستخدم</label>
                                            <input type="text" name="phone">
                                        </div>
                                    </div>
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg-6">
                                            <label class="form-label">  </label>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <input type="hidden" name="role" value="admin">
                                    <div class="row mg-b-20">
                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label"> صلاحية المستخدم</label>
                                                {!! Form::select('roles_name[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
            </div>
            <!-- Container closed -->
        </div>
        <!-- main-content closed -->
    @endsection
    @section('js')


        <!-- Internal Nice-select js-->
        <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>

        <!--Internal  Parsley.min js -->
        <script src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
        <!-- Internal Form-validation js -->
        <script src="{{ URL::asset('assets/js/form-validation.js') }}"></script>
    @endsection
