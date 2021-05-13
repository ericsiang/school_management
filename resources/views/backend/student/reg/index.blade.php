@extends('admin.master')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box bb-3 border-warning">
                <div class="box-header">
                    <h4 class="box-title">Student <strong>Search</strong></h4>
                </div>

                <div class="box-body">
                    <form action="{{ route('student.reg.search') }}" method="GET">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Year<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <select name="year_id" id="year_id"  class="form-control">
                                            <option value="" selected='' disabled=''>Select Year</option>
                                            @foreach ($data['years'] as $year)
                                                <option value="{{ $year->id }}" {{ $data['year_id']== $year->id ? 'selected' : ''  }}>{{ $year->name }}</option>
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
                                    <h5>Class<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <select name="class_id" id="class_id"  class="form-control">
                                            <option value="" selected='' disabled=''>Select Class</option>
                                            @foreach ($data['classes'] as $class)
                                                <option value="{{ $class->id }}" {{ $data['class_id']== $class->id  ? 'selected' : ''  }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('class_id')
                                        <span style="color:#FF0000;">{{ $message }}</span>
                                    @enderror
                                </div><!-- End form-group -->
                            </div> <!-- End col-md-4 -->

                            <div class="col-md-4" style="padding-top:25px">
                                <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search" value="Search">
                                <input type="button" class="btn btn-rounded btn-dark mb-5" onClick="location.replace('{{ route('student.reg.index') }}')" value="clear">
                            </div>
                        </div><!-- End row -->
                    </form>
                </div><!-- End box-body -->
            </div> <!-- End box bb-3 border-warning -->
        </div><!-- End first col-12 -->

        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Student List</h3>
                    <a href="{{ route('student.reg.create') }}" style="float:right"
                        class="btn btn-rounded btn-success mb-5">Add Student </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Image</th>
                                    @if (Auth::user()->role=='Admin')
                                    <th>Code</th>
                                    @endif
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assign_students as $k => $assign_student)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $assign_student->student_user->name }}</td>
                                    <td>{{ $assign_student->student_user->id_no }}</td>
                                    <td>{{ $assign_student->roll }}</td>
                                    <td>{{ $assign_student->student_year->name }}</td>
                                    <td>{{ $assign_student->student_class->name }}</td>
                                    <td>{{ $assign_student->student_user->code }}</td>
                                    <td>  <img id="showimg" src="{{ !empty($assign_student->student_user->image) ? asset($assign_student->student_user->image) : asset('upload/no_image.jpg') }}" alt="" style='width:100px;height:100px;'></td>
                                    <td>
                                        <form
                                            action="{{ route('student.reg.delete',['assign_student'=>$assign_student->id]) }}"
                                            method="POST" id='myForm_{{ $assign_student->id }}'>
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a href="{{ route('student.reg.edit',['assign_student'=>$assign_student->id]) }}"
                                            class="btn btn-info ">Edit</a>
                                        <a href="javascript:void(0);" onClick='on_delete({{ $assign_student->id }});'
                                            class="btn btn-danger ">Delete</a>
                                    </td>





                                </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                      <tr>
                        <th>SL</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                  </tfoot> --}}
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection

@section('body_last_add_js')
<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{ asset('backend/js/pages/data-table.js')}}"></script>
<script>
    function on_delete(id) {
        Swal.fire({
            title: '確定刪除嗎？',
            text: "你將無法恢復此刪除！",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確定删除！'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#myForm_' + id).submit();
            }
        })
        //alert(action);
    }
</script>
@endsection
