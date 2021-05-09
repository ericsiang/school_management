@extends('admin.master')

@section('content')

<section class="content">
    <div class="row">

      <div class="col-12">

       <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Assign Subject Detials</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <h4>Class Name : {{ $assign_subjects[0]->student_class->name  }}</h4>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th width="5%">SL</th>
                        <th>Student Subject</th>
                        <th>full_mark</th>
                        <th>pass_mark</th>
                        <th>subjective_mark</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($assign_subjects as $k => $assign_subject)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $assign_subject->student_subject->name }}</td>
                            <td>{{ $assign_subject->full_mark }}</td>
                            <td>{{ $assign_subject->pass_mark }}</td>
                            <td>{{ $assign_subject->subjective_mark }}</td>

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
@endsection




