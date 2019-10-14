@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Categories</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><span>Tasks</span></a></li>
                    <li class="active"><span>Categories</span></li>
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
                            <h6 class="panel-title txt-dark">Categories</h6>
                        </div>
                        <a class="btn btn-primary btn-xs pull-right" href="{{ route('category.create') }}"> Add New</a>
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
                                            <th>Category Name</th>
                                            <th>Parent</th>
                                            <th>Is Active</th>
                                            <th>Is Blog_Cat</th>
                                            <th>Image</th>
                                            <th>Enable / Disable</th>

                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $number = 1; @endphp

                                        @if($categories->count() > 0)
                                            @foreach($categories as $category)

                                                <tr>
                                                    <td>{{ $number++ }}</td>
                                                    <td>{{ $category->category_name }}</td>
                                                    <td> @if($category->parent) {{ $category->parent}}
                                                        @else
                                                            <i class="zmdi zmdi-close-circle" style="color: red; font-size: 22px;"></i>
                                                        @endif </td>
                                                    <td>
                                                        {!! ($category->is_active == 1) ?
                                                        '<span class = "label label-success">Active</span>' :
                                                   '<span class = "label label-danger">Inactive</span>' !!}
                                                    </td>

                                                    <td>
                                                        {!! ($category->is_blog == 1) ?
                                                        '<span class = "label label-success">Yes</span>' :
                                                   '<span class = "label label-danger">No</span>' !!}
                                                    </td>

                                                    <td> @if($category->image) <i class="zmdi zmdi-image" style="color: green; font-size: 22px;"></i>
                                                        @else
                                                            <i class="zmdi zmdi-close-circle" style="color: red; font-size: 22px;"></i>
                                                        @endif
                                                    </td>



                                                    <td>
                                                        <form method="POST" >
                                                            @csrf
                                                            <input
                                                                value="{{ $category->is_active }}"
                                                                @if($category->is_active === 1) checked=checked @endif
                                                                name="is_active"
                                                                type="checkbox"
                                                                data-toggle="toggle"
                                                                id="{{$category->id}}"
                                                                class="is_active js-switch js-switch-1"
                                                                data-color="#2ECD99"
                                                                data-secondary-color="#EE8470"
                                                                data-size="small"
                                                            />
                                                            <input hidden value="{{ $category->id }}"
                                                                   name="{{ $category->id }}">
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <form action="{{ route('category.destroy',$category->id) }}"
                                                              method="POST" id="form-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn-group btn-group-xs">
                                                                <a href="{{ route('category.edit', $category->id) }}"
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
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Basic Table -->
        </div>

        <script type="text/javascript">

            $(document).ready(function() {
                $('.is_active').change(function(){
                    var _token    = $("input[name='_token']").val();
                    var is_active = $(this).val();
                    var category_id   =  $(this).attr('id');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('category.activation') }}",
                        data: {_token:_token, is_active:is_active,category_id:category_id},
                        success: function(data) {
                            if($.isEmptyObject(data.error)){
                                console.log(data.success);
                                // alert(data.success);
                                window.setTimeout(function(){location.reload()},100);
                            }else{
                                console.log(data.error);
                            }
                        }
                    });
                });

            });

        </script>

    </div><!-- main -->
@endsection
