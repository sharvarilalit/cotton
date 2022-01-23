@extends('layouts.master')
@section('title')
    {{ isset($getmarketbyId) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ isset($getmarketbyId) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Market</a></li>
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

                                <form id="myform" action='{{ route('market.store') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getmarketbyId) ? $getmarketbyId->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="market_name">{{ __('Market Name') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="market_name" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Name"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->market_name : '' }}"
                                                    required="" maxlength="30" />
                                                @error('market_name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Location') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="market_location" class="form-control" id="market_location"
                                                    placeholder="Location"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->market_location : '' }}"
                                                    required="" maxlength="30"/>
                                                @error('market_location')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Truck') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="truck_id" class="form-control" id="truck_id" required=""  {{ isset($getmarketbyId) ? 'readonly' : '' }} >
                                                    <option value="">Select</option>
                                                    @foreach ($truck as $cats)
                                                        <option
                                                            {{ isset($getmarketbyId) && $cats->id == $getmarketbyId->truck_id ? 'selected' : '' }}
                                                            value={{ $cats->id }}>{{ $cats->truck_no }}</option>
                                                    @endforeach
                                                </select>
                                                @error('truck_id')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    placeholder="date" required=""
                                                    value="{{ isset($getmarketbyId) ? date('Y-m-d',strtotime($getmarketbyId->date)) : '' }}" {{ isset($getmarketbyId) ? 'readonly' : '' }} />
                                                @error('date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>


                                           <div class="form-group">
                                                <label for="name">{{ __('Truck Weight (in Quintal)') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="truck_weight_qi" class="form-control" id="truck_weight_qi"
                                                    placeholder="Weight in Quintal" onkeyup="calculateAmount()"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->truck_weight_qi : '' }}"
                                                    required="" />
                                                @error('truck_weight_qi')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Truck Weight (in Kg)') }}</label>
                                                <input type="text" name="truck_weight_kg" class="form-control" id="truck_weight_kg"
                                                    placeholder="Weight in Kg" onkeyup="calculateAmount()"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->truck_weight_kg*10 : '' }}"
                                                     />
                                                @error('truck_weight_kg')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <input type="hidden" name="kg" id="kg"  value="{{ isset($getmarketbyId) ? $getmarketbyId->truck_weight_kg*10 : '' }}"/>

                                            <div class="form-group">
                                                <label for="name">{{ __('Market Price') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="market_price" class="form-control" id="market_price"
                                                    placeholder="Price" onkeyup="calculateAmount()"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->market_price : '' }}"
                                                    required="" />
                                                @error('market_price')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Total Amount') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="total_amount" class="form-control"
                                                    id="total_amount" placeholder="Total Amount"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->total_amount : '' }}"
                                                     readonly />
                                                @error('total_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary"> {{ isset($getmarketbyId) ? 'Update' : 'Submit' }} </button>
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
            let price = $("#market_price").val();
            let truck_weight_qi = $("#truck_weight_qi").val();
            let truck_weight_kg = $("#truck_weight_kg").val()==''?0:$("#truck_weight_kg").val();
            let total = parseInt(truck_weight_qi) + "." +parseInt(truck_weight_kg);
            //alert(total);
            let getValue = total * price;
            $("#total_amount").val(getValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $("#kg").val(truck_weight_kg);
            // alert(getValue);
        }

    </script>
    <script type="text/javascript">
        $(function() {

            $('#myform').validate({
                rules: {
                    market_name: {
                        required: true,
                    },
                    market_location: {
                        required: true,
                    },
                    truck_weight_qi: {
                         required: true,
                    },
                    truck_id: {
                         required: true,
                    },
                    market_price: {
                        required: true,
                    },
                    total_amount: {
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
