@extends('admin.master')

@section('content')

<section class="content">
    <div class="row">

      <div class="col-12">

       <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Assign Subject List</h3>
            <a href="{{ route('assign_subject.create') }}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Assign Subject</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th width="5%">SL</th>
                        <th>Class Name</th>
                        <th width="25%">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($assign_subjects as $k => $assign_subject)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $assign_subject->student_class->name }}</td>

                            <td>
                                <a href="{{ route('assign_subject.edit',['class_id'=>$assign_subject->class_id]) }}"  class="btn btn-info ">Edit</a>
                                <a href="{{ route('assign_subject.detials',['class_id'=>$assign_subject->class_id]) }}"  class="btn btn-primary ">Detials</a>

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
        function on_delete(id){
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
                      $('#myForm_'+id).submit();
                    }
            })
            //alert(action);
        }
    </script>
@endsection




