@extends('layout.master')
@section('title', 'View User')
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                </div>


                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>DateCreated</th>
                                    <th>DateUpdated</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($user as $user_list)
                                    <tr class="odd gradeX total{{$user_list->id}}">
                                        <td>{{$user_list->name}}</td>
                                        <td>{{$user_list->description}}</td>
                                        <td>{{$user_list->created_at}}</td>
                                        <td>{{$user_list->updated_at}}</td>
                                        <td align="center">
                                            <button class="btn btn-primary btn-sm edit-modal-user"   data-id="{{$user_list->id}}" data-name="{{$user_list->name}}" data-description="{{$user_list->description}}" data-created_at="{{$user_list->created_at}}" data-updated_at="{{$user_list->updated_at}}"><span class="glyphicon glyphicon-edit"></span></button>

                                            <button class="btn confirm btn-danger btn-sm edit-modal-delete"  data-id="{{$user_list->id}}" data-name="{{$user_list->name}}" data-description="{{$user_list->description}}" data-created_at="{{$user_list->created_at}}" data-updated_at="{{$user_list->updated_at}}" ><span class="glyphicon glyphicon-trash"></span></button>


                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <!-- /.table-responsive -->

                            <div class="modal fade open_modal" id="myModal" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <button type="button" class="close closeC"
                                                    data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                Edit User Form
                                            </h4>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <div class="modal-body">

                                                <form id="form" class="form-horizontal" role="form">

                                                    <div class="form-group">

                                                        <label  class="col-sm-2 control-label">Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="user_name" name="name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="margin-top: 30px;">
                                                        <label class="col-sm-2 control-label">Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" rows="5" id="user_description" name="description" ></textarea>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">

                                                        <div class="col-sm-10">
                                                            <input type="hidden" class="form-control" id="user_id" name="id" />
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" id="save-btn-training" data-token="{{ csrf_token() }}">Save changes</button>
                                                    </div>

                                                </form>
                                            </div>

                                            <meta name="_token" content="{!! csrf_token() !!}" />
                                        </div>

                                        <!-- Modal Footer -->

                                    </div>

                                </div>
                            </div>


                            <div class="modal fade" id="deleteModal" aria-labelledby="myModalLabel" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header alert-danger">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>
                                                Confirmation Message</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure that you want to permanently delete the selected
                                                element?</p>
                                            <input type="hidden" id="delete_id">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">No
                                            </button>
                                            <button type="button" class="btn btn-danger delete_user_btn"
                                                    data-dismiss="modal" value=""
                                                    data-token="{{ csrf_token() }}" data-dismiss="modal">Delete
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>



                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.container-fluid -->
        </div>
    </div>


@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>


    <script>

        $(document).on('click', '.edit-modal-user', function() {

            $('#user_id').val($(this).data('id'));
            $('#user_name').val($(this).data('name'));
            $('#user_description').val($(this).data('description'));

            $('#myModal').modal('show');

            $('#save-btn-training').click(function(){



                $.ajax({
                    type: 'get',
                    url: './editUser',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': $("#user_id").val(),
                        'name' : $('#user_name').val(),
                        'description': $('#user_description').val()

                    },
                    success: function(data) {
                        console.log(data);
                        $('.total' + data.id).replaceWith("<tr class='total" + data.id + "'><td>" + data.name + "</td><td>" + data.description+ " </td><td>" + data.created_at+ " </td><td>" + data.updated_at+ "</td><td align='center'><button class='btn btn-primary btn-sm edit-modal-user' data-id='" + data.id + "' data-name='" + data.name+ "' data-description='" + data.description+ "' ><span class='glyphicon glyphicon-edit'></span></button> <button class='btn confirm btn-danger btn-sm edit-modal-delete' data-id='" + data.id + "' data-name='" + data.name+ "' data-description='" + data.description+ "' ><span class='glyphicon glyphicon-trash'></span></button></td></tr>");
                        $('#myModal').modal('hide');
                        $('#user_id').val($(this).data(''));
                        $('#user_description').val($(this).data(''));
                        $('#user_name').val($(this).data(''));

                    }
                });

            });
        })


    </script>


    <script>
        $(document).on("click", ".edit-modal-delete", function () {


            $('#deleteModal').modal('show');

            var deleted_id = $(this).data('id');

            $("#delete_id").val(deleted_id);

        });

        $('.delete_user_btn').click(function () {

            var user_id = $("#delete_id").val();
            var id = user_id;

            var url = "deleteUser";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: url + '/' + id,
                success: function (data) {
                    console.log(id);
                    $(".total" + id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        })
    </script>


@endsection