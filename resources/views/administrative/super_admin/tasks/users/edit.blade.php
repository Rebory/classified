@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Add New Role</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><span>Tasks</span></a></li>
                    <li class="active"><span>Add New Role</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title end-->


        <!-- Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Add new Role</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                            <!-- start validation messages -->
                            <div class="hidden" id="msg"></div>
                            <div id="hideError" class="alert alert-danger print-error-msg" style="display:none; ">
                                <ul style="list-style: none;"></ul>
                            </div>
                            <!--end  validation messages -->

                            <div class="form-wrap mt-10">
                                {!! Form::open([
'route'        => ['users.update', 'id' => $user->id],
'method'       => 'PATCH',
'autocomplete' => 'off',
'id'           => 'ajax-form',
'files'        => 'true',
'redirectTo'   => route('users.index'),
]) !!}
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('first_name'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('first_name', $user->first_name, ['class' =>
                                            ($errors->has('first_name')) ? 'form-control  is-invalid' : 'form-control ' ,
                                            'placeholder' => 'First Name']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('last_name'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('last_name', $user->last_name, ['class' =>
                                            ($errors->has('last_name')) ? 'form-control  is-invalid' : 'form-control ' ,
                                            'placeholder' => 'Last Name']) }}
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('Mobile Number'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('mobile_number', $user->mobile_number, ['class' =>
                                            ($errors->has('mobile_number')) ? 'form-control  is-invalid' : 'form-control ' ,
                                            'placeholder' => 'Enter Mobile Number']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('Email'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('email', $user->email, ['class' =>
                                            ($errors->has('email')) ? 'form-control  is-invalid' : 'form-control ' ,
                                            'placeholder' => 'Enter Email id']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('Set_Password'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('password', null, ['class' =>
                                            ($errors->has('password')) ? 'form-control  is-invalid' : 'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('location'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::select('location', $locationList, $user->location_id, ['class' => 'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('Role'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::select('role', $userRoleOptions, $user->role, ['class' => 'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::submit('Save',['class' => 'btn btn-success']) }}
                                        </div>
                                    </div>

                                    <!--            <div class="col-sm-6 ol-md-6 col-xs-12">
                                                    <div class="panel panel-default card-view">
                                                        <div class="panel-heading">
                                                            <div class="pull-left">
                                                                <h6 class="panel-title txt-dark">File Upload (max file size)</h6>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body">
                                                                <p class="text-muted">You can add a max file size by <code>data-max-file-size</code>.</p>
                                                                <div class="mt-40">
                                                                    <input type="file" id="input-file-max-fs" class="dropify" data-max-file-size="5M" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Row -->
    </div> <!-- end container -->
@endsection
