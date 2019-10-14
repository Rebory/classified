@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Slider Details</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><span>Tasks</span></a></li>
                    <li class="active"><span>Slider Details</span></li>
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
                            <h6 class="panel-title txt-dark">Slider Detail</h6>
                        </div>
                        <a class="btn btn-primary btn-xs pull-right" href="{{ route('slider.create') }}"> Add New</a>
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
                                            <th width="2%" >Sno.</th>
                                            <th>Slide Image</th>
                                            <th>Title 1</th>
                                            <th>Title 2</th>
                                            <th>Title 3</th>
                                            <th>Title 4</th>
                                            <th>Title 5</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $number = 1; @endphp

                                        @if($sliders->count() > 0)
                                            @foreach($sliders as $slider)
                                                <tr>
                                                    <td>{{ $number++ }}</td>
                                                    <td>
                                                        @if($slider->image != null &&
                                                         file_exists(public_path('uploads/slider/' . $slider->image)))
                                                            <br>
                                                            <img src="{{ asset('uploads/slider/'. $slider->image) }}"
                                                                 class="img img-thumbnail"
                                                                 width="100" height="100"/>
                                                            @else
                                                            -----
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($slider->title1) {{ $slider->title1 }} @else ----- @endif
                                                    </td>

                                                    <td>
                                                        @if($slider->title2) {{ $slider->title2 }} @else ----- @endif
                                                    </td>

                                                    <td>
                                                        @if($slider->title3) {{ $slider->title3 }} @else ----- @endif
                                                    </td>

                                                    <td>
                                                        @if($slider->title4) {{ $slider->title4 }} @else ----- @endif
                                                    </td>

                                                    <td>
                                                        @if($slider->title5) {{ $slider->title5 }} @else ----- @endif
                                                    </td>

                                                    <td>
                                                        <form  method="post" action="{{ route('slider.destroy', $slider->id ) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn-group btn-group-xs">
                                                                <a href="{{ route('slider.edit', $slider->id) }}"
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
                                    {{ $sliders->links() }}
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
