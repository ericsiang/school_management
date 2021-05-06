@extends('admin.master')

@section('content')
<section class="content">
    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Add Fee Amount</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {{-- @if($errors->all())
               @php
                    dd($errors);
               @endphp
            @endif --}}

            <div class="row">
                <div class="col">
                    <form action="{{ route('fee_category_amount.update',['fee_category_id'=>$fee_category_amounts[0]->fee_category_id]) }}" method='POST'>
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="add_item">
                                        <div class="form-group">
                                            <h5>Fee Category<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="fee_category_id" id="select"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Fee Category</option>
                                                    @foreach ($data['fee_categories'] as $fee_category)
                                                    <option value="{{ $fee_category->id }}"
                                                        {{ old('fee_category_id')==$fee_category->id  ? 'selected' : ''  }} {{ $fee_category_amounts[0]->fee_category_id==$fee_category->id ? 'selected' : '' }}>
                                                        {{ $fee_category->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('fee_category_id')
                                            <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @foreach($fee_category_amounts as $k => $fee_category_amount)
                                        <div class="delete_whole_extra_item_add">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <h5>Student Class<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="class_id[]" required  class="form-control">
                                                                <option value="" selected='' disabled=''>Select Fee Category
                                                                </option>
                                                                @foreach ($data['classes'] as $class)
                                                                <option value="{{ $class->id }}"
                                                                    {{ old('class')==$class->id  ? 'selected' : ''  }} {{ $fee_category_amount->class_id==$class->id ? 'selected' : '' }}>
                                                                    {{ $class->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        @error('class_id.0')
                                                        <span style="color:#FF0000;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <h5>Amount<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="amount[]" class="form-control"
                                                                value="{{ $fee_category_amount->amount }}">
                                                            <div class="help-block"></div>
                                                        </div>
                                                        @error('amount.0')
                                                        <span style="color:#FF0000;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-2" style="padding-top:25px;">
                                                    <span class="btn btn-success addeventmore" ><i
                                                            class='fa fa-plus-circle'></i></span>
                                                    <span class="btn btn-danger removeeventmore" ><i class='fa fa-minus-circle'></i></span>
                                                </div>
                                            </div>
                                        </div> <!-- end delete_whole_extra_item_add-->
                                        @endforeach

                                    </div><!--end add_item -->
                                </div><!--end  col-12 -->
                            <div><!-- end row -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                            </div>
                    </form>

                </div>  <!-- /.col -->

            </div> <!-- /.row -->

        </div> <!-- /.box-body -->

    </div> <!-- /.box -->


</section>

<div style="visibility:hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="col-md-5">
                    <div class="form-group">

                        <h5>Student Class<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="class_id[]" required  class="form-control">
                                <option value="" selected='' disabled=''>Select Fee Category</option>
                                @foreach ($data['classes'] as $class)
                                <option value="{{ $class->id }}" {{ old('class')==$class->id  ? 'selected' : ''  }} >
                                    {{ $class->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('class_id')
                        <span style="color:#FF0000;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Amount<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="amount[]" class="form-control" value="{{ old('name') }}">
                            <div class="help-block"></div>
                        </div>
                        @error('amount')
                        <span style="color:#FF0000;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2" style="padding-top:25px;">
                    <span class="btn btn-success addeventmore" ><i class='fa fa-plus-circle'></i></span>
                    <span class="btn btn-danger removeeventmore" ><i class='fa fa-minus-circle'></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('body_last_add_js')
<script>
    $(document).ready(function () {
        var counter = 0;

        $(document).on('click','.addeventmore',function(){
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest('.add_item').append(whole_extra_item_add);
            counter++;
        });

        $(document).on('click','.removeeventmore',function(){
            $(this).closest('.delete_whole_extra_item_add').remove();
            counter-=1;
        });


    });



</script>
@endsection
