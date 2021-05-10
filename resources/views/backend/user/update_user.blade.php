@extends('admin.master')

@section('content')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Edit User</h4>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('user.update',['user'=>$user->id]) }}" method='POST'>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>User Role <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="role" id="role" required class="form-control"
                                                @if ($user->id==1)
                                                    disabled
                                                @endif>
                                                    <option value="" selected='' disabled=''>Select Role</option>
                                                    <option value="Admin" {{ $user->role=='Admin' ? 'selected' : ''  }}>Admin</option>
                                                    <option value="Operator" {{ $user->role=='Operator' ? 'selected' : ''  }}>Operator</option>
                                                </select>
                                            </div>
                                            @error('usertype')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                                   >
                                                <div class="help-block"></div>
                                            </div>
                                            @error('name')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Email <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}""
                                                   >
                                                <div class="help-block"></div>
                                            </div>
                                            @error('email')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Password<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control"
                                                    >
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div> --}}
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
