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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('messages.market') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.add') }}</li>
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
                                                <label for="market_name">{{ __('messages.market_name') }} <span
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
                                                <label for="name">{{ __('messages.location') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="market_location" class="form-control"
                                                    id="market_location" placeholder="Location"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->market_location : '' }}"
                                                    required="" maxlength="30" />
                                                @error('market_location')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.truck') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="truck_id" class="form-control" id="truck_id"
                                                    onchange="getTruckUniqueCode()" required=""
                                                    {{ isset($getmarketbyId) ? 'disabled' : '' }}>
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
                                                <label for="name">{{ __('messages.truck_code') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="truck_code" class="form-control"
                                                    id="truck_code" onchange="getTruckChargesDate()" required=""
                                                    {{ isset($getmarketbyId) ? 'readonly' : '' }}>
                                                    <option value="{{isset($getmarketbyId) ? 'readonly' : '' }}">Select</option>

                                                    <option
                                                            {{ isset($getmarketbyId) && $getmarketbyId->truck_code !='' ? 'selected' : '' }}
                                                            value={{ isset($getmarketbyId)?$getmarketbyId->truck_code:''}}>{{ isset($getmarketbyId)?$getmarketbyId->truck_code:'Select' }}</option>
                                                </select>
                                                @error('truck_code')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="name">{{ __('messages.trip') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="number" name="trip" class="form-control" id="trip"
                                                    placeholder="Truck Trip" readonly
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->trip : '' }}"
                                                    required="" onchange="calculateVillageAmount()" />
                                                @error('trip')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.product_type') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="product_type" class="form-control"
                                                    id="product_type" required="" readonly>
                                                    <option value="">Select</option>
                                                    <option value="1"
                                                        {{ isset($getmarketbyId) && $getmarketbyId->product == '1' ? 'selected' : '' }}>
                                                        Cotton</option>
                                                    <option value="2"
                                                        {{ isset($getmarketbyId) && $getmarketbyId->product == '2' ? 'selected' : '' }}>
                                                        Wheat</option>

                                                </select>
                                                @error('product')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="date" class="form-control" id="date"
                                                    placeholder="date" required="" readonly
                                                    value="{{ isset($getmarketbyId) ? date('Y-m-d', strtotime($getmarketbyId->date)) : '' }}"
                                                    {{ isset($getmarketbyId) ? 'readonly' : '' }} />
                                                @error('date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <?php if (!empty($getmarketbyId)) {
                                                $kintal_kilo = explode('.', $getmarketbyId->quantity);
                                                // var_dump($kintal_kilo);exit;
                                            }
                                            ?>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.truck_orignal_weight') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="truck_weight_o" class="form-control"
                                                    id="truck_weight_o" placeholder="Weight in Quintal"
                                                    required="" readonly />
                                                @error('truck_weight_o')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="name">{{ __('messages.truck_weight_qnt') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="truck_weight_qi" class="form-control"
                                                    id="truck_weight_qi" placeholder="Weight in Quintal"
                                                    onkeyup="calculateAmount()"
                                                    value="{{ isset($getmarketbyId) ? (int) $kintal_kilo[0] : '' }}"
                                                    required="" />
                                                @error('truck_weight_qi')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="name">{{ __('messages.truck_weight_kg') }}</label>
                                                <input type="text" name="truck_weight_kg" class="form-control"
                                                    id="truck_weight_kg" placeholder="Weight in Kg"
                                                    onkeyup="calculateAmount()"
                                                    value="{{ isset($getmarketbyId) ? (int) $kintal_kilo[1] : '' }}"
                                                    maxlength="2" />
                                                @error('truck_weight_kg')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <input type="hidden" name="kg" id="kg"
                                                value="{{ isset($getmarketbyId) ? $getmarketbyId->truck_weight_kg * 10 : '' }}" />

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.market_price') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="market_price" class="form-control"
                                                    id="market_price" placeholder="Price" onkeyup="calculateAmount()"
                                                    value="{{ isset($getmarketbyId) ? $getmarketbyId->market_price : '' }}"
                                                    required="" />
                                                @error('market_price')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.total_amount') }} <span
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
                                            <button type="submit" class="btn btn-primary">
                                                {{ isset($getmarketbyId) ? 'Update' : 'Submit' }} </button>
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
        $(function() {

            getTruckUniqueCode();
            getTruckChargesDate();

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

        function calculateAmount() {
            let price = $("#market_price").val();
            let truck_weight_qi = $("#truck_weight_qi").val();
            let truck_weight_kg = $("#truck_weight_kg").val() == '' ? 0 : $("#truck_weight_kg").val();
            let total = parseInt(truck_weight_qi) + "." + parseInt(truck_weight_kg);
            //alert(total);
            let getValue = total * price;
            $("#total_amount").val(getValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $("#kg").val(truck_weight_kg);
            // alert(getValue);
        }


        function getTruckUniqueCode() {
            let truck_no = $("#truck_id").val();

            $.ajax({
                type: 'POST',
                url: '/gettruckcode',
                data: {
                    'truck_no': truck_no,
                    '_token': '<?php echo csrf_token(); ?>'
                },
                success: function(data) {
                    console.log(data.data);
                    if (data.data.length > 0) {
                        $("#village_charges").val(data.total_village_cost);

                        $.each(data.data, function(key, value) {
                            console.log(value)
                            $("#truck_code").append('<option value=' + value.truck_unique_code + '>' + value
                                .truck_unique_code + '</option>');
                        });


                    } else {
                        $("#village_charges").val(data.total_village_cost);

                    }
                }
            });


        }

        function getTruckChargesDate() {
            let truck_charges_id = $("#truck_code").val();

            $.ajax({
                type: 'POST',
                url: '/gettruckChargesdetails',
                data: {
                    'truck_charges_id': truck_charges_id,
                    '_token': '<?php echo csrf_token(); ?>'
                },
                success: function(data) {
                    console.log('getTruckChargesDate', data);
                    let result = data.data;
                    if (result.length > 0) {
                        $("#trip").val(result[0].trip);
                        $("#product_type").val(result[0].product);
                        $("#date").val(result[0].date);
                        $("#truck_weight_o").val(result[0].total_quantity);


                    }
                }
            });


        }
    </script>
@endsection
