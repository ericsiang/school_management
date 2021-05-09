@extends('admin.master')

@section('content')
<section class="content">
    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Add Assign Subject</h4>
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
                    <form action="{{ route('assign_subject.store') }}" method='POST'>
                        @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="add_item">
                                        <div class="form-group">
                                            <h5>Class Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id" id="select"  class="form-control">
                                                    <option value="" selected='' disabled=''>Select Class</option>
                                                    @foreach ($data['classes'] as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ old('class_id')==$class->id  ? 'selected' : ''  }}>
                                                        {{ $class->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('class_id')
                                            <span style="color:#FF0000;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Student Subject<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subject_id[]" required  class="form-control">
                                                            <option value="" selected='' disabled=''>Select Student Subject
                                                            </option>
                                                            @foreach ($data['school_subjects'] as $subject)
                                                            <option value="{{ $subject->id }}"
                                                                {{ old('subject_id')==$subject->id  ? 'selected' : ''  }}>
                                                                {{ $subject->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    @error('subject_id.0')
                                                    <span style="color:#FF0000;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Full Mark<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="full_mark[]" class="form-control"
                                                            value="">
                                                        <div class="help-block"></div>
                                                    </div>
                                                    @error('full_mark.0')
                                                    <span style="color:#FF0000;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Pass Mark<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="pass_mark[]" class="form-control"
                                                            value="">
                                                        <div class="help-block"></div>
                                                    </div>
                                                    @error('pass_mark.0')
                                                    <span style="color:#FF0000;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Subjevtive Mark<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="subjective_mark[]" class="form-control"
                                                            value="">
                                                        <div class="help-block"></div>
                                                    </div>
                                                    @error('subjective_mark.0')
                                                    <span style="color:#FF0000;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2" style="padding-top:25px;">
                                                <span class="btn btn-success addeventmore" ><i
                                                        class='fa fa-plus-circle'></i></span>

                                            </div>
                                        </div>
                                    </div><!-- add_item -->
                                </div><!--  col-12 -->
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
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Student Subject<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subject_id[]" required  class="form-control">
                                <option value="" selected='' disabled=''>Select Student Subject
                                </option>
                                @foreach ($data['school_subjects'] as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id')==$subject->id  ? 'selected' : ''  }}>
                                    {{ $subject->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('subject_id')
                        <span style="color:#FF0000;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Full Mark<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="full_mark[]" class="form-control"
                                value="">
                            <div class="help-block"></div>
                        </div>
                        @error('full_mark')
                        <span style="color:#FF0000;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Pass Mark<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="pass_mark[]" class="form-control"
                                value="">
                            <div class="help-block"></div>
                        </div>
                        @error('pass_mark')
                        <span style="color:#FF0000;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Subjevtive Mark<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="subjective_mark[]" class="form-control"
                                value="">
                            <div class="help-block"></div>
                        </div>
                        @error('subjective_mark')
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
