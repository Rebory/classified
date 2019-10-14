@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Attributes</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><span>Tasks</span></a></li>
                    <li class="active"><span>Attributes</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->



        <div class="row">
            <!-- Basic Table -->
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Attribute  list</h6>
                        </div>
                        <a class="btn btn-primary btn-xs pull-right" href="{{ route('attribute.create') }}"> Add New</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <!-- start validation messages -->
                            @if(Session::has('success'))
                                <div class="alert alert-solid alert-success ">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{!! session('success') !!}</strong>
                                </div>
                        @endif
                            <!--end  validation messages -->
                            <div class="table-wrap mt-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Attribute Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $number = 1; @endphp

                                        @if($attributes->count() > 0)
                                            @foreach($attributes as $attribute)
                                                <tr>
                                                    <td>{{ $number++ }}</td>
                                                    <td>{{ $attribute->attribute_name }}</td>
                                                    <td>
                                                        <form  method="post" action="{{ route('attribute.destroy', $attribute->id ) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn-group btn-group-xs">
                                                                <a href="{{ route('attribute.edit', $attribute->id) }}"
                                                                   class="btn btn-primary ">
                                                                    <i class="zmdi zmdi-edit"></i> </a>
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    @endforeach
                                                </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="8" class="text-danger text-danger"> no data found.</td>
                                                    </tr>
                                                @endif

                                        </tbody>

                                    </table>
                                    {{ $attributes->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Basic Table -->
        </div>

    </div><!-- main -->

@endsection
