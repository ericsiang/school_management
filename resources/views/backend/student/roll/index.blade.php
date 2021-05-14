@extends('admin.master')

@section('head_last_add')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box bb-3 border-warning">
                <div class="box-header">
                    <h4 class="box-title">Student <strong>Roll Generator</strong></h4>
                </div>

                <div class="box-body">
                    <form action="{{ route('student.roll.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Year<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <select name="year_id" id="year_id" class="form-control">
                                            <option value="" selected='' disabled=''>Select Year</option>
                                            @foreach ($data['years'] as $year)
                                            <option value="{{ $year->id }}"
                                                {{ $data['year_id']== $year->id ? 'selected' : ''  }}>{{ $year->name }}
                                            </option>
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
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="" selected='' disabled=''>Select Class</option>
                                            @foreach ($data['classes'] as $class)
                                            <option value="{{ $class->id }}"
                                                {{ $data['class_id']== $class->id  ? 'selected' : ''  }}>
                                                {{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('class_id')
                                    <span style="color:#FF0000;">{{ $message }}</span>
                                    @enderror
                                </div><!-- End form-group -->
                            </div> <!-- End col-md-4 -->

                            <div class="col-md-4" style="padding-top:25px">
                                <input type="button" id="search" class="btn btn-rounded btn-dark mb-5" name="search" value="Search">
                                <input type="button" class="btn btn-rounded btn-dark mb-5"
                                    onClick="location.replace('{{ route('student.roll.index') }}')" value="clear">
                            </div>
                        </div><!-- End row -->




                        <!-- ////////////////////// Roll Generate Table ////////////////////   -->

                        <div class="row d-none" id="roll_generate">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped" style="width:100%;">
                                    <thead>
                                        <th>ID No</th>
                                        <th>Student Name</th>
                                        <th>Father Name</th>
                                        <th>Gender</th>
                                        <th>Roll</th>
                                    </thead>
                                    <tbody id="roll_generate_tr">

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- End row d-none -->

                        <input type="submit" value="Roll Generator" class="btn btn-info">
                    </form>
                    <!-- /.col -->
                </div><!-- End box-body -->
            </div> <!-- End box bb-3 border-warning -->
        </div><!-- End first col-12 -->
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


    $(document).on('click', '#search', function () {
        var year_id = $('#year_id').val();
        var class_id = $('#class_id').val();
        $.ajax({
            url: "{{ route('student.roll.get_students')}}",
            type: "GET",
            data: {
                'year_id': year_id,
                'class_id': class_id
            },
            success: function (data) {
                $('#roll_generate').removeClass('d-none');
                var html = '';
                console.log(data);
                $.each(data, function (key, v) {
                    html +=
                        '<tr>' +
                        '<td>' + v.student_user.id_no +
                        '<input type="hidden" name="student_id[]" value="' + v.student_id +
                        '"></td>' +
                        '<td>' + v.student_user.name + '</td>' +
                        '<td>' + v.student_user.fname + '</td>' +
                        '<td>' + v.student_user.gender + '</td>' +
                        '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="' +
                        v.roll + '"></td>' +
                        '</tr>';
                });
                html = $('#roll_generate_tr').html(html);
            }
        });
    });

</script>
@endsection
