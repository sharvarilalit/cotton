@extends('layouts.master')
@section('title')
    {{ isset($getfarmerbyId) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ isset($getfarmerbyId) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Farmer</a></li>
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
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="bs-stepper">

                                <form id="myform" action='{{ route('farmer.store') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getfarmerbyId) ? $getfarmerbyId->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Farmer Name') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="name" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Name"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->name : '' }}"
                                                    required="" />
                                                @error('name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Location') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="location" class="form-control" id="location"
                                                    placeholder="Location"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->location : '' }}"
                                                    required="" />
                                                @error('location')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Contact Number') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="contact" class="form-control" id="contact"
                                                    placeholder="Contact"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->contact : '' }}"
                                                    required="" />
                                                @error('contact')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        function calculateAmount() {
            let price = $("#price").val();
            let quantity = $("#quantity").val();

            let getValue = price * quantity;
            $("#total_amount").val(getValue);
            // alert(getValue);
        }

        function calculatePendingAmount() {
            let total_amount = $("#total_amount").val();
            let paid_amount = $("#paid_amount").val();

            let pending_amount = total_amount - paid_amount;
            $("#pending_amount").val(pending_amount);
        }
    </script>
    <script type="text/javascript">
        $(function() {

            $('#myform').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    location: {
                        required: true,
                    },
                    contact: {
                        required: true,
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
