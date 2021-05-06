@extends('admin.master')

@section('content')

<section class="content">
    <div class="row">

      <div class="col-12">

       <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Fee Category  Amount Detials</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <h4>Fee Category : {{ $fee_category_amounts[0]->fee_category->name  }}</h4>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th width="5%">SL</th>
                        <th>Class Name</th>
                        <th>Amount</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($fee_category_amounts as $k => $fee_category_amount)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $fee_category_amount->student_class->name }}</td>
                            <td>{{ $fee_category_amount->amount }}</td>

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




