@extends('admin.master')

@section('content')

<section class="content">
    <div class="row">

      <div class="col-12">

       <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Exam Type List</h3>
            <a href="{{ route('exam_type.create') }}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Exam Type</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th width="5%">SL</th>
                        <th>Name</th>
                        <th width="25%">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($exam_types as $k => $exam_type)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $exam_type->name }}</td>

                            <td>
                                <form action="{{ route('exam_type.delete',['exam_type'=>$exam_type->id]) }}" method="POST" id='myForm_{{ $exam_type->id }}'>
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <a href="{{ route('exam_type.edit',['exam_type'=>$exam_type->id]) }}"  class="btn btn-info ">Edit</a>
                                <a href="javascript:void(0);" onClick='on_delete({{ $exam_type->id }});' class="btn btn-danger ">Delete</a>
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
                title: '??????????????????',
                text: "??????????????????????????????",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '???????????????'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#myForm_'+id).submit();
                    }
            })
            //alert(action);
        }
    </script>
@endsection




