@extends('layouts.backend_master')

@section('content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Role List</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                                        <li><a href="#"><span>Tasks</span></a></li>
                                        <li class="active"><span>Role List</span></li>
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
                            <h6 class="panel-title txt-dark">Role List</h6>
                        </div>
                        <a class="btn btn-primary btn-xs pull-right" href="{{ route('users.create') }}"> Add New User</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile No.</th>
                                            <th>Role</th>
                                            <th>Is Active</th>
                                            <th>Actions</th>
                                            <th>Ban Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $number = 1; @endphp

                                        @if($users->count() > 0)
                                            @foreach($users as $user)

                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile_number }}</td>
                                            <td>
                                                @if($user->role == 1) <span class = "label label-primary">Admin</span> @endif
                                                @if($user->role == 2) <span class = "label label-primary">Editor</span> @endif
                                                @if($user->role == 3) <span class = "label label-primary">User</span> @endif
                                            </td>

                                            <td>
                                                {!! ($user->is_active == 1) ? '<span class = "label label-success">Active</span>' :
                                           '<span class = "label label-danger">Inactive</span>' !!}
                                            </td>
                                            <td>
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST" id="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                <div class="btn-group btn-group-xs">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary "> <i class="zmdi zmdi-edit"></i> </a>
                                                    <button type="submit" class="btn btn-danger"> <i class="zmdi zmdi-delete"></i></button>
                                                </div>
                                                </form>
                                            </td>

                                            <td>
                                                <form method="POST" >
                                                    @csrf
                                                    <input
                                                     value="{{ $user->is_active }}"
                                                     @if($user->is_active === 0) checked=checked @endif
                                                     name="is_active"
                                                     type="checkbox"
                                                     data-toggle="toggle"
                                                     id="{{$user->id}}"
                                                     class="is_active js-switch js-switch-1"
                                                     data-color="#2ECD99"
                                                     data-secondary-color="#EE8470"
                                                     data-size="small"
                                                    />
                                                       <input hidden value="{{ $user->id }}" name="{{ $user->id }}">

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
                                    {{ $users->links() }}
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
                    var user_id   =  $(this).attr('id');

                    $.ajax({
                        type: "POST",
                        url: '{{ route('user.activation') }}',
                        data: {_token:_token, is_active:is_active,user_id:user_id},
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
