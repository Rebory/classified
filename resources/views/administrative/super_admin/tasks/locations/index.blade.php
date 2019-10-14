@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Room types</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><span>Tasks</span></a></li>
                    <li class="active"><span>Locations</span></li>
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
                            <h6 class="panel-title txt-dark">Locations</h6>
                        </div>
                        <a class="btn btn-primary btn-xs pull-right" href="{{ route('locations.create') }}"> Add New</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Location</th>
                                            <th>Parent Location</th>
                                            <th>Postal Code</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $number = 1; @endphp

                                        @if($locations->count() > 0)
                                            @foreach($locations as $location)

                                                <tr>
                                                    <td>{{ $number++ }}</td>
                                                    <td>{{ $location->location_name }}</td>
                                                    <td>{{ ($location->parent != null) ? $location->parent : 'N/A' }}</td>
                                                    <td>{{ $location->postal_code }}</td>

                                                    <td>
                                                        <form action="{{ route('locations.destroy',$location->id) }}"
                                                              method="POST" id="form-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn-group btn-group-xs">
                                                                <a href="{{ route('locations.edit', $location->id) }}"
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
                                    {{ $locations->links() }}
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
