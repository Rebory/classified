@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Add Slide</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><span>Tasks</span></a></li>
                    <li class="active"><span>Add Slide</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title end-->




        <!-- Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Add Slide</h6>
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
                                {{ Form::model($slider, ['url' => route('slider.update', $slider->id), 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true ]) }}
                                <div class="row">

                                    <div class=" col-lg-6 col-md-6 col-sm-8 col-xs-12">

                                        @if($slider->image != null &&
                                    file_exists(public_path('uploads/slider/' . $slider->image)))
                                            <br>
                                            <img src="{{ asset('uploads/slider/'. $slider->image) }}"
                                                 class="img img-thumbnail"
                                                 width="100" height="150"/>
                                        @endif

                                        <div class="form-group">
                                            {{ Form::label('choose_new_slide_image_(if update)'),['class' => 'control-label mb-10 text-left' ] }}
                                            {{ Form::file('image',
                                              [
                                                'class'  =>'dropify',
                                                'id'     => 'input-file-max-fs',
                                                'data-max-file-size' => '2M',
                                                'multiple' => true,
                                              ]) }}
                                            @if($errors->has('image'))
                                                <div style="color: red;">
                                                    {{ $errors->first('image') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('title_1'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('title1', $slider->title1 , ['class' =>
                                            ($errors->has('title1')) ? 'form-control  is-invalid' : 'form-control']) }}
                                            @if($errors->has('title1'))
                                                <div class="has-error">
                                                    {{ $errors->first('title1') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('title_2'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('title2', $slider->title2 , ['class' =>
                                            ($errors->has('title2')) ? 'form-control  is-invalid' : 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('title_3'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('title3', $slider->title3 , ['class' =>
                                            ($errors->has('title3')) ? 'form-control  is-invalid' : 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('title_4'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('title4', $slider->title4 , ['class' =>
                                            ($errors->has('title4')) ? 'form-control  is-invalid' : 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('title_5'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('title5', $slider->title5 , ['class' =>
                                            ($errors->has('title5')) ? 'form-control  is-invalid' : 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::submit('Update',['class' => 'btn btn-success pull-right']) }}
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
