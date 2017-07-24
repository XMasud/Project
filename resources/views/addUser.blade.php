@extends('layout.master')
@section('title', 'Add User')
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                </div>


                <!-- /.col-lg-12 -->
            </div>

            @if(Session::has('message'))

                <div id="successMessage" class="alert alert-success alert-dismissible fade in " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                    </button>
                    <strong>{{ Session::get('message') }}</strong>
                </div>
            @endif

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <form role="form" action="{{url('user')}}" method="POST" class="form-horizontal" files="true" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" placeholder="Enter Name" name="name" id="name">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="save-btn" id="save-btn">Save</button>
                            </div>

                        </form>

                    </div>
                </div>
        </div>

        <!-- /.container-fluid -->
    </div>
    </div>


@endsection
@section('script')
    <script>


        $('#successMessage').delay(3000).slideUp(300);

        window.setTimeout(function() { $(".alert-success").alert('close'); }, 2000);
    </script>

@endsection