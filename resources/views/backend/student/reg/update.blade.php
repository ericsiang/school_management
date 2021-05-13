@extends('admin.master')

@section('head_last_add')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Update Student</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col">
                    <form action="{{ route('student.reg.update',['assign_student'=>$assign_student->id]) }}" method='POST' enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Student Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" value="{{ $assign_student->student_user->name }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('name')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div> <!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Father's Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="fname" class="form-control" value="{{ $assign_student->student_user->fname  }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('fname')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div> <!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mother's Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mname" class="form-control" value="{{  $assign_student->student_user->mname }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('mname')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div> <!-- End form-group -->
                                    </div> <!-- End col-md-4 -->
                                </div><!-- End row -->



                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mobile<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mobile" class="form-control" value="{{ $assign_student->student_user->mobile }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('mobile')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div> <!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Address<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="address" class="form-control" value="{{ $assign_student->student_user->address  }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('address')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Gender<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" id="gender"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Gender</option>
                                                    <option value="M" {{ $assign_student->student_user->gender=='M' ? 'selected' : ''  }}>M</option>
                                                    <option value="F" {{ $assign_student->student_user->gender=='F' ? 'selected' : ''  }}>F</option>
                                                </select>
                                            </div>
                                            @error('gender')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->
                                </div><!-- End row -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Religion<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="religion" id="religion"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Religion</option>
                                                    <option value="Islam" {{ $assign_student->student_user->religion=='Islam' ? 'selected' : ''  }}>Islam</option>
                                                    <option value="Hindu" {{ $assign_student->student_user->religion=='Hindu' ? 'selected' : ''  }}>Hindu</option>
                                                    <option value="Christan" {{ $assign_student->student_user->religion=='Christan' ? 'selected' : ''  }}>Christan</option>
                                                </select>
                                            </div>
                                            @error('religion')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date of Birth<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="dob" class="form-control" value="{{ $assign_student->student_user->dob }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('dob')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Discount<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="discount" class="form-control" value="{{ $assign_student->student_discount->discount }}">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('discount')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->
                                </div><!-- End row -->


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Year<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="year_id" id="year_id"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Year</option>
                                                    @foreach ($data['years'] as $year)
                                                        <option value="{{ $year->id }}" {{ $assign_student->student_year->id== $year->id ? 'selected' : ''  }}>{{ $year->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('year_id')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Class<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id" id="class_id"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Class</option>
                                                    @foreach ($data['classes'] as $class)
                                                        <option value="{{ $class->id }}" {{ $assign_student->student_class->id== $class->id  ? 'selected' : ''  }}>{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('class_id')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Group<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="group_id" id="group_id"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Group</option>
                                                    @foreach ($data['groups'] as $group)
                                                        <option value="{{ $group->id }}" {{ $assign_student->student_group->id==$group->id  ? 'selected' : ''  }}>{{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('group_id')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->
                                </div><!-- End row -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Shift<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="shift_id" id="shift_id"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Shift</option>
                                                    @foreach ($data['shifts'] as $shift)
                                                        <option value="{{ $shift->id }}" {{ $assign_student->student_shift->id== $shift->id ? 'selected' : ''  }}>{{ $shift->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('shift_id')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Profile Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="image" class="form-control" id="image">
                                                <div class="help-block"></div>
                                            </div>
                                            @error('image')
                                                <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <img id="showimg" src="{{ !empty($assign_student->student_user->image) ? asset($assign_student->student_user->image) : asset('upload/no_image.jpg') }}" alt="" style='width:100px;height:100px;border:1px soild #000000;'>
                                            </div>
                                        </div><!-- End form-group -->
                                    </div> <!-- End col-md-4 -->
                                </div><!-- End row -->
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
        $('#image').change(function(e){
            var reader= new FileReader();
            reader.onload=function(e){
                $('#showimg').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
