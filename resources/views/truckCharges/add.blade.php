@extends('layouts.master')
@section('title')
    {{ isset($getTruckbyId) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ isset($getTruckbyId) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Truck Entries</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <!-- form start -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form method="post"  action='{{ route('truck.store') }}' id="myform">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($getTruckbyId) ? $getTruckbyId->id : 0  }}" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Truck Number</label>
                                <input type="text" name="truck_no" class="form-control" id="truck_no" placeholder="Truck Number"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->truck_no : '' }}" required="">
                                @error('truck_no')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Truck Mapadi Name</label>
                                <input type="text" name="truck_mapadi_name" class="form-control" id="truck_mapadi_name" placeholder="Truck Mapadi Name"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->truck_mapadi_name : '' }}" required="">
                                @error('truck_mapadi_name')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Truck Filler/Person Name</label>
                                <input type="text" name="truck_person_name" class="form-control" id="truck_person_name" placeholder="Truck Filler Name"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->truck_person_name : '' }}" required="">
                                @error('truck_person_name')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Truck Additional Details</label>
                                <textarea type="text" name="additional_details" class="form-control" id="additional_details" placeholder="Additional Details"
                                   >{{ isset($getTruckbyId) ? $getTruckbyId->additional_details : '' }}</textarea>
                                @error('additional_details')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')

    <script>
        $(function() {
           
            $('#myform').validate({
                rules: {
                    truck_no: {
                        required: true
                    },
                    truck_mapadi_name: {
                        required: true
                    },
                    truck_person_name: {
                        required: true
                    },
                },
                messages: {
                    truck_no: {
                        required: "Please enter a Truck Number",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
