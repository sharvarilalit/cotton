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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Farmer Transactions</a></li>
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

                                <form id="myform" action='{{ route('ftransaction.store') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getfarmerbyId) ? $getfarmerbyId->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                          
                                            <div class="form-group">
                                                <label for="name">{{ __('messages.farmar_name') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="farmer_id" class="form-control" id="farmer_id" required="" {{ isset($getfarmerbyId) ? 'readonly' : '' }}>
                                                    <option value="">Select</option>
                                                    @foreach ($farmer as $cats)
                                                        <option
                                                            {{ isset($getfarmerbyId) && $cats->id == $getfarmerbyId->farmer_id ? 'selected' : '' }}
                                                            value={{ $cats->id }}>{{ $cats->name }} ({{ $cats->location }})</option>
                                                    @endforeach
                                                </select>
                                                @error('farmer_id')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name">{{ __('messages.truck') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="truck_id" class="form-control" id="truck_id" required="" {{ isset($getfarmerbyId) ? 'readonly' : '' }}>
                                                    <option value="">Select</option>
                                                    @foreach ($truck as $cats)
                                                        <option
                                                            {{ isset($getfarmerbyId) && $cats->id == $getfarmerbyId->truck_id ? 'selected' : '' }}
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
                                                    required=""/>
                                                @error('trip')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                             <div class="form-group">
                                                <label for="name">{{ __('messages.product_type') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="product_type" class="form-control" id="product_type" required="" {{ isset($getfarmerbyId) ? 'readonly' : '' }}>
                                                    <option value="">Select</option>
                                                    <option value="1" {{  isset($getfarmerbyId) && $getfarmerbyId->product == '1' ? 'selected' : '' }}>Cotton</option>
                                                    <option value="2" {{  isset($getfarmerbyId) && $getfarmerbyId->product == '2' ? 'selected' : '' }}>Wheat</option>
                                                   
                                                </select>
                                                @error('product')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>                                           

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.mapadi_name') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="mapadi_name" class="form-control" id="mapadi_name"
                                                    placeholder="Mapadi Name" 
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->mapadi_name : '' }}"
                                                    required="" onkeypress="validateText(event)" maxlength="100" {{ isset($getfarmerbyId) ? 'readonly' : '' }}/>
                                                @error('mapadi_name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.through_person_name') }}</label>
                                                <input type="text" name="through_person_name" class="form-control" id="through_person_name"
                                                    placeholder="Through Person Name" 
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->through_person_name : '' }}"
                                                     onkeypress="validateText(event)" maxlength="100" {{ isset($getfarmerbyId) ? 'readonly' : '' }}/>
                                                @error('through_person_name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="name">{{ __('messages.date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    placeholder="date" required=""
                                                    value="{{ isset($getfarmerbyId) ? date('Y-m-d',strtotime($getfarmerbyId->date)) : '' }}"  {{ isset($getfarmerbyId) ? 'readonly' : '' }}/>
                                                @error('date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            {{-- <div class="form-group">
                                                <label for="menu">Cotton Weight</label>
                                                <select name="cotton_weight" id="cotton_weight" class="form-control " required="">
                                                    <option value="">--- Select Cotton Weight ---</option>
                                                    <option value="kintal" <?php if (!empty($getfarmerbyId)) {
                                                        echo $getfarmerbyId->cotton_weight == 'kintal' ? 'selected' : '';
                                                    } ?>> Kintal </option>
                                                                                                        <option value="kilo" <?php if (!empty($getfarmerbyId)) {
                                                        echo $getfarmerbyId->cotton_weight == 'kilo' ? 'selected' : '';
                                                    } ?>> Kilo </option>
                                                </select>
                                            </div> --}}

                                            <?php if (!empty($getfarmerbyId)) {
                                                         $kintal_kilo = explode('.', $getfarmerbyId->weight); 
                                                        // var_dump($kintal_kilo);exit;
                                                     }
                                            ?>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.cotton_weight_qnt') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="cotton_weight_qi" class="form-control" id="cotton_weight_qi"
                                                    placeholder="Weight in Quintal" onkeyup="calculateAmount()"
                                                    value="{{ isset($getfarmerbyId) ? (int)$kintal_kilo[0] : '' }}"
                                                    required="" {{ isset($getfarmerbyId) ? 'readonly' : '' }}/>
                                                @error('cotton_weight_qi')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.cotton_weight_kg') }}</label>
                                                <input type="text" name="cotton_weight_kg" class="form-control" id="cotton_weight_kg"
                                                    placeholder="Weight in Kg" onkeyup="calculateAmount()"
                                                    value="{{ isset($getfarmerbyId) ? (int)$kintal_kilo[1] : '' }}"
                                                     maxlength="2" {{ isset($getfarmerbyId) ? 'readonly' : '' }}/>
                                                @error('cotton_weight_kg')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <input type="hidden" name="kg" id="kg"  value="{{ isset($getfarmerbyId) ? $getfarmerbyId->cotton_weight_kg*10 : '' }}"/>


                                            <div class="form-group">
                                                <label for="name">{{ __('messages.price') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="price" class="form-control" id="price"
                                                    placeholder="Price" onkeyup="calculateAmount()"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->price : '' }}"
                                                    required="" {{ isset($getfarmerbyId) ? 'readonly' : '' }}/>
                                                @error('price')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.total_amount') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="total_amount" class="form-control"
                                                    id="total_amount" placeholder="Total Amount"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->total_amount : '' }}"
                                                     readonly />
                                                @error('total_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.paid_amount') }} </label>
                                                <input type="text" name="paid_amount" class="form-control"
                                                    id="paid_amount" placeholder="Paid Amount"
                                                    onkeyup="{{ isset($getfarmerbyId) ? 'calculatePaidPendingAmount()' : 'calculatePendingAmount()' }}" />
                                                    <span id="paid-error" style="color: red"></span>
                                                @error('paid_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <input type="hidden" name="pending_state" id="pending_state" value="{{ isset($getfarmerbyId) ? $getfarmerbyId->pending_amount : '' }}">

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.pending_amount') }} </label>
                                                <input type="text" name="pending_amount" class="form-control"
                                                    id="pending_amount" placeholder="Pending Amount"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->pending_amount : '' }}"
                                                    readonly />
                                                @error('pending_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            @if (isset($getfarmerbyId)) 
                                              <div class="form-group">
                                                <label for="name">{{ __('messages.transction_payment_date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="trans_date" class="form-control" id="trans_date"
                                                    placeholder="date" required=""/>
                                                @error('trans_date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="menu">{{__('messages.payment_method')}}</label>
                                                <span class="payment-error" style="color: red">
                                                    {{ isset($getfarmerbyId) ? '*' : '' }}
                                                </span>
                                                <select name="payment_mode" id="payment_mode" class="form-control" {{ isset($getfarmerbyId) ? 'required' : '' }}>
                                                    <option value="">--- Select Payment Mode ---</option>
                                                    <option value="Online" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_mode == 'Online' ? 'selected' : '';
} ?>> Online </option>
                                                    <option value="Offline" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_mode == 'Offline' ? 'selected' : '';
} ?>> Offline </option>
                                                </select>

                                            </div>

                                           <!--  <div class="form-group">
                                                <label for="menu">{{__('messages.payment_status')}}</label>
                                                 <span class="payment-error" style="color: red">
                                                     {{ isset($getfarmerbyId) ? '*' : '' }}
                                                 </span>
                                                <select name="payment_status" id="payment_status" class="form-control" {{ isset($getfarmerbyId) ? 'required' : '' }}>
                                                    <option value="">--- Select Payment Status ---</option>
                                                    <option value="Pending" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_status == 'Pending' ? 'selected' : '';
} ?>> Pending </option>
                                                    <option value="Paid" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_status == 'Paid' ? 'selected' : '';
} ?>> Paid </option>
                                                </select>
                                               
                                            </div> -->


                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary">{{ isset($getfarmerbyId) ? 'Update' : 'Submit' }}</button>
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
            let cotton_weight_qi = $("#cotton_weight_qi").val();
            let cotton_weight_kg = $("#cotton_weight_kg").val()==''?0:$("#cotton_weight_kg").val();

            let total = parseInt(cotton_weight_qi) +"."+ parseFloat(cotton_weight_kg);
            //alert(total);
            let getValue = total * price;
            $("#total_amount").val(getValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $("#kg").val(cotton_weight_kg);
            // alert(getValue);
        }

        function calculatePendingAmount() {
            let total_amount = $("#total_amount").val();
            let paid_amount = $("#paid_amount").val();
            let pending_amount = parseInt(total_amount.replace(/,/g , '')) - paid_amount;
            $("#pending_amount").val(pending_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

           // console.log('pending_amount', pending_amount)

            if(pending_amount != 0){
                // $("#payment_status").attr("required","");
                $("#payment_mode").attr("required","");
                $(".payment-error").text("*");
            }
            else{
                // $("#payment_status").removeAttr("required","");
                $("#payment_mode").removeAttr("required","");
                $(".payment-error").text(" "); 
            }
            
            if(paid_amount > parseInt(total_amount.replace(/,/g , ''))){
                $("#paid-error").text("Amount should be less than or equal to total amount");
            }
            else{
                $("#paid-error").text("");
            }
        }

        function validateText(e){
            var key = e.keyCode;
            if ((key >= 33 && key <= 64) || ( key >=91 && key <= 96) || ( key >=123 && key <= 126)) {
                e.preventDefault();
            }
        }

        function calculatePaidPendingAmount() {
            let total_amount = $("#pending_state").val();
            let paid_amount = $("#paid_amount").val();
            let pending_amount = total_amount - paid_amount;
            $("#pending_amount").val(pending_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

            console.log("paid amount"+paid_amount);
             console.log("to amount"+total_amount);

            if(parseInt(paid_amount) > parseInt(total_amount)){
                $("#paid-error").text("You already paid some amount then amount should be less than or equal to Pending Amount");
            }
            else{
                $("#paid-error").text("");
            }

            // if(pending_amount == 0){
            //     $("#payment_status").val("Paid").attr("selected","selected");
            //    // $("#payment_status").attr("disabled","");
            // }
            // else{
            //     $("#payment_status").val("Pending").attr("selected","selected");
            //   //  $("#payment_status").removeAttr("disabled","");
            // }
        }
    </script>
    <script type="text/javascript">
        $(function() {

            $('#myform').validate({
                rules: {
                    farmer_id: {
                        required: true,
                    },
                    cotton_weight_qi: {
                         required: true,
                    },
                    truck_id: {
                         required: true,
                    },
                    price: {
                        required: true,
                    },
                    total_amount: {
                        required: true,
                    }
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
                },
                submitHandler:function(element) {
                    let paid_error = $("#paid-error").text();
                    console.log(paid_error);
                    if(paid_error != "") {
                        return false;
                    }
                    else{
                        return true;
                    }
                }
            });
        });
    </script>
@endsection
