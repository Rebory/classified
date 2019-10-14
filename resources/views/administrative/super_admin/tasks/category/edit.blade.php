@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Add room type</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><span>Tasks</span></a></li>
                    <li class="active"><span>Add room type</span></li>
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
                            <h6 class="panel-title txt-dark">Add new room type</h6>
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
'route'        => ['category.update', 'id' => $category->id],
'method'       => 'PATCH',
'autocomplete' => 'off',
'id'           => 'ajax-form',
'files'        => 'true',
'redirectTo'   => route('category.index'),
]) !!}
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('category_name'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::text('category_name', $category->category_name, ['class' =>
                                            ($errors->has('category_name')) ? 'form-control  is-invalid' : 'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('parent_category_name'), ['class' => 'control-label mb-10 text-left'] }}
                                            {{ Form::select('parent_category_name', $categories, $category->parent_id, ['class' =>
                                            ($errors->has('parent_category_name')) ? 'form-control  is-invalid' : 'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('choose_image'),['class' => 'control-label mb-10 text-left' ] }}
                                            {{ Form::file('image',
                                              [
                                                'class'  =>'dropify',
                                                'id'     => 'input-file-max-fs',
                                                'data-max-file-size' => '2M',
                                                'multiple' => true
                                              ]) }}
                                        </div>

                                    <div class="form-group" style="padding-left: 15px;">
                                        {{ Form::label('is_active'),['class' => 'control-label mb-10 text-left' ]  }}
                                        {{ Form::checkbox('status', 1, ($category->is_active == 1 ) ? true:false), ['class' => 'checkbox']}}
                                    </div>

                                    <div class="form-group" style="padding-left: 15px;">
                                        {{ Form::label('is_blog'),['class' => 'control-label mb-10 text-left' ]  }}
                                        {{ Form::checkbox('is_blog', 1, ($category->is_blog == 1 ) ? true:false), ['class' => 'checkbox']}}
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::submit('Save',['class' => 'btn btn-success']) }}
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
