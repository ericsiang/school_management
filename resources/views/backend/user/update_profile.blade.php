@extends('admin.master')

@section('head_last_add')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Manage Profile</h4>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('profile.update',['user'=>$user->id]) }}" method='POST' enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>User Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('name')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>User Email <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('email')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>User Mobile<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('mobile')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>User Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="add" class="form-control" value="{{ $user->add }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('add')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>User Gender <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" id="select" required class="form-control">
                                                    <option value="" selected='' disabled=''>Select Gender</option>
                                                    <option value="M" {{ $user->gender=='M' ? 'selected' : ''  }}>Man</option>
                                                    <option value="F" {{ $user->gender=='F' ? 'selected' : ''  }}>Female</option>
                                                </select>
                                            </div>
                                            @error('gender')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>User Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="img" class="form-control" id="img">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('img')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <img id="showimg" src="{{ !empty($user->img) ? asset($user->img) : asset('upload/no_image.jpg') }}" alt="" style='width:100px;height:100px;border:1px soild #000000;'>
                                            </div>
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
@section('body_last_add_js')
<script type="text/javascript">
    $( document ).ready(function() {
        $('#img').change(function(e){
            var reader= new FileReader();
            reader.onload=function(e){
                $('#showimg').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
