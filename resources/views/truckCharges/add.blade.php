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
                    <h1> {{ isset($getTruckbyId) ? 'Update' : __('messages.add') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{__('messages.truck_entries')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.add')}}</li>
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
                    <form method="post"  action='{{ route('truck.charges.store') }}' id="myform">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($getTruckbyId) ? $getTruckbyId->id : 0  }}" />
                        <div class="card-body">
                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Truck Number</label>
                                <input type="text" name="truck_no" class="form-control" id="truck_no" placeholder="Truck Number"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->truck_no : '' }}" required="">
                                @error('truck_no')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
 -->
                            <div class="form-group">
                                <label for="name">{{__('messages.truck')}} <span
                                        style='color:red'>*</span></label>
                                <select type="text" name="truck_id" class="form-control" id="truck_id" required=""  {{ isset($getTruckbyId) ? 'readonly' : '' }} onchange="calculateVillageAmount()">
                                    <option value="">Select</option>
                                    @foreach ($truck as $cats)
                                        <option
                                            {{ isset($getTruckbyId) && $cats->id == $getTruckbyId->truck_id ? 'selected' : '' }}
                                            value={{ $cats->id }}>{{ $cats->truck_no }}</option>
                                    @endforeach
                                </select>
                                @error('truck_id')
                                    <small style="color:red">{{ $message }}</small>
                                @enderror
                            </div>

                              <div class="form-group">
                                <label for="name">{{ __('messages.truck_trip') }} <span
                                        style='color:red'>*</span></label>
                                <input type="number" name="trip" class="form-control" id="trip"
                                    placeholder="Truck Trip" 
                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->trip : '' }}"
                                    required="" onchange="calculateVillageAmount()" />
                                @error('trip')
                                    <small style="color:red">{{ $message }}</small>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="name">{{ __('messages.product_type') }} <span
                                        style='color:red'>*</span></label>
                                <select type="text" name="product_type" class="form-control" id="product_type" required="" {{ isset($getfarmerbyId) ? 'readonly' : '' }} onchange="calculateVillageAmount()">
                                    <option value="">Select</option>
                                    <option value="1" {{  isset($getfarmerbyId) && $getfarmerbyId->product == '1' ? 'selected' : '' }}>Cotton</option>
                                    <option value="2" {{  isset($getfarmerbyId) && $getfarmerbyId->product == '2' ? 'selected' : '' }}>Wheat</option>
                                   
                                </select>
                                @error('product')
                                    <small style="color:red">{{ $message }}</small>
                                @enderror
                            </div>                

                            <div class="form-group">
                                <label for="name">{{ __('messages.date') }} <span
                                        style='color:red'>*</span></label>
                                <input type="date" name="date" class="form-control" id="date"
                                    placeholder="date" required=""
                                    value="{{ isset($getTruckbyId) ? date('Y-m-d',strtotime($getTruckbyId->date)) : '' }}" {{ isset($getTruckbyId) ? 'readonly' : '' }}/>
                                @error('date')
                                    <small style="color:red">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('messages.village_price_rate') }}<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="village_charges" class="form-control" id="village_charges" placeholder="Village Price Rate"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->village_charges : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()" readonly="">
                                @error('village_charges')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('messages.vehicle_cost') }}<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="vehicle_charges" class="form-control" id="vehicle_charges" placeholder="Vehicle Cost"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->vehicle_charges : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('vehicle_charges')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('messages.labour_cost') }}<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="labor_charges" class="form-control" id="labor_charges" placeholder="Labour Cost"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->labor_charges : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('labor_charges')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('messages.village_commission') }}<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="village_commision" class="form-control" id="village_commision" placeholder="Village Commission"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->village_commision : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('village_commision')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('messages.route_charges') }}<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="route_charges" class="form-control" id="route_charges" placeholder="Route Charges"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->route_charges : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('route_charges')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('messages.vehicle_fillingout_charges') }}<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="vehicle_filling_out_charges" class="form-control" id="vehicle_filling_out_charges" placeholder="Route Charges"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->vehicle_filling_out_charges : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('vehicle_filling_out_charges')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('messages.angadi_and_return_person_charges') }}<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="angadi_return_person_charges" class="form-control" id="angadi_return_person_charges" placeholder="Angadi and Return Person Charges"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->angadi_return_person_charges : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('angadi_return_person_charges')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                           <!--  <div class="form-group">
                                <label for="exampleInputEmail1">Total Charges Amount<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="total_charges_amount" class="form-control" id="total_charges_amount" placeholder="Total Charges Amount"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->total_charges_amount : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('total_charges_amount')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div> -->

                         <!--    <div class="form-group">
                                <label for="exampleInputEmail1">Jingping Amount<span
                                        style='color:red'>*</span></label>
                                <input type="text" name="jingping_amount" class="form-control" id="jingping_amount" placeholder="Jingping Amount"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->jingping_amount : '' }}" required="" onkeypress="validateAmount(event)"  onkeyup="calculateAmount()">
                                @error('jingping_amount')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div> -->

                            <div class="form-group">
                                <label for="name">{{ __('messages.total_amount') }} <span
                                        style='color:red'>*</span></label>
                                <input type="text" name="total_amount" class="form-control"
                                    id="total_amount" placeholder="Total Amount"
                                    value="{{ isset($getTruckbyId) ? $getTruckbyId->total_amount : '' }}"
                                     readonly />
                                @error('total_amount')
                                    <small style="color:red">{{ $message }}</small>
                                @enderror
                            </div>


                          <!--   <div class="form-group">
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

<script type="text/javascript">
     function validateAmount(e){
        var key = e.keyCode;
        if (!(key >= 48 && key <= 57)) {
            e.preventDefault();
        }
    }
     function calculateAmount() {
        let village_charges = $("#village_charges").val();
        let vehicle_charges = $("#vehicle_charges").val();
        let labor_charges = $("#labor_charges").val();
        let village_commision = $("#village_commision").val();
        let route_charges = $("#route_charges").val();
        let vehicle_filling_out_charges = $("#vehicle_filling_out_charges").val();
        let angadi_return_person_charges = $("#angadi_return_person_charges").val();
        // let total_charges_amount = $("#total_charges_amount").val();
        // let jingping_amount = $("#jingping_amount").val();
        

        let total = parseInt(village_charges) + parseFloat(vehicle_charges)+ parseFloat(labor_charges)+ parseFloat(village_commision)+ parseFloat(route_charges)+ parseFloat(vehicle_filling_out_charges)+ parseFloat(angadi_return_person_charges);
        $("#total_amount").val(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            // alert(getValue);
    }

    function calculateVillageAmount() {
       let truck_no = $("#truck_id").val();
       let village_charges = $("#village_charges").val(); 
       let product_type = $("#product_type").val(); 
       let truck_trip = $("#trip").val(); 

        $.ajax({
           type:'POST',
           url:'/gettruckdetails',
           data:{ 'product_type':product_type,'truck_trip':truck_trip,'truck_no':truck_no ,'_token':'<?php echo csrf_token() ?>'},
           success:function(data) {
                if(data.msg != "" && data.total_village_cost == 0) {
                     alert(data.msg);
                     $("#village_charges").val(data.total_village_cost);
                }
                else{
                   $("#village_charges").val(data.total_village_cost);
                }
              

           }
        });

    }
</script>

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
