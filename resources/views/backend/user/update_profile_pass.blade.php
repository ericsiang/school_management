@extends('admin.master')


@section('content')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Change Password</h4>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('profile.pass.update',['user'=>$user->id]) }}" method='POST'>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Current Passworde<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="current_password" class="form-control" value="">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('current_password')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Password<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control" value="">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('password')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Confirm Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password_confirmation" class="form-control" value="">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('password_confirmation')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                        </div>
                    </form>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
@endsection

