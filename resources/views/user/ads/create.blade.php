@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">New Post</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active"><span>New Post</span></li>
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
                            <h6 class="panel-title txt-dark">Add Post</h6>
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
'route'        => 'attribute.store',
'method'       => 'POST',
'autocomplete' => 'off',
'id'           => 'ajax-form',
'files'        => 'true',
'redirectTo'   => route('attribute.index'),
]) !!}
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            {{ Form::label('attribute_name'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('attribute_name', null, ['class' =>'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::submit('Save',['class' => 'btn btn-success']) }}
                                        </div>
                                    </div>

                                </div>
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
