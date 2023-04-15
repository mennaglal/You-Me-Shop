@extends('dashboard.layouts.master')
@section('page-title','Roles')
@section('css')
    <link href="{{asset('assets/ltr/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/css/forms/theme-checkbox-radio.css')}}" />
    <link href="{{asset('assets/ltr/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #new_role_btn{
            margin-top: 37px;
            margin-left: 20px;
        }
    </style>
@endsection


@section('content')
    <!-- messages error and add ,edit delete messages -->
    <div class="row justify-content-center mt-4">
        <div class="col-11">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('add'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('add') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('edit') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success mb-4" id="new_role_btn" href="{{ route('roles.create') }}">Add New Role</a>
                @endcan
            </div>
        </div>
    </div>
    @can('role-list')
        <div id="tableDropdown" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td >{{ ++$key }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td width="280px">
                                        @can('role-edit')
                                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                        @endcan
                                        @can('role-delete')
                                                <a type="button"
                                                   class="btn btn-danger"
                                                   data-id="{{$role->id}}"
                                                   data-toggle="modal"
                                                   data-target="#deleteModal">
                                                   Delete
                                                </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-notification" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" id="standardModalLabel">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="icon-content">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" style="color: red !important;">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </div>
                            <h3>Are you sure to complete the deleting process?</h3>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <form class="delete_form" action="{{route('roles.destroy')}}" method="post">
                                {{ method_field('delete') }}
                                {{csrf_field()}}
                                <input type="hidden" id="id" name="id">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endcan
@endsection
@section('js')
    <script src="{{asset('assets/ltr/js/scrollspyNav.js')}}"></script>
    <script>
        $('#deleteModal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-footer .delete_form #id').val(id);
        });
    </script>
@endsection
