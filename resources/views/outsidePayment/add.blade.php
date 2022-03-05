@extends('layouts.master')
@section('title')
    {{ isset($getOutbyId) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ isset($getOutbyId) ? 'Update' : 'Add' }}</h1>
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

                                <form id="myform" action='{{ route('outsidep.store') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getOutbyId) ? $getOutbyId->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                          
                                         
                                             <div class="form-group">
                                                <label for="agent_name">{{ __('messages.agent_name') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="agent_name" class="form-control" id="agent_name"
                                                    placeholder="Agent Name" 
                                                    value="{{ isset($getOutbyId) ? $getOutbyId->name : '' }}"
                                                    required="" onkeypress="validateText(event)" maxlength="100" {{ isset($getOutbyId) ? 'readonly' : '' }}/>
                                                @error('name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                           

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    placeholder="date" required=""
                                                    value="{{ isset($getOutbyId) ? date('Y-m-d',strtotime($getOutbyId->date)) : '' }}"  {{ isset($getOutbyId) ? 'readonly' : '' }}/>
                                                @error('date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.amount') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="amount" class="form-control" id="amount"
                                                    placeholder="Amount" 
                                                    value="{{ isset($getOutbyId) ? $getOutbyId->amount : '' }}"
                                                    required="" {{ isset($getOutbyId) ? 'readonly' : '' }}/>
                                                @error('price')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>                                          

                                         @if (isset($getOutbyId)) 
                                            <div class="form-group">
                                                <label for="name">{{ __('messages.paid_amount') }} </label>
                                                <input type="text" name="paid_amount" class="form-control"
                                                    id="paid_amount" placeholder="Paid Amount"
                                                    onkeyup="calculatePaidPendingAmount()" />
                                                    <span id="paid-error" style="color: red"></span>
                                                @error('paid_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <input type="hidden" name="pending_state" id="pending_state" value="{{ isset($getOutbyId) ? $getOutbyId->pending_amount : '' }}">
                                           
                                            <div class="form-group">
                                                <label for="name">{{ __('messages.pending_amount') }} </label>
                                                <input type="text" name="pending_amount" class="form-control"
                                                    id="pending_amount" placeholder="Pending Amount"
                                                    value="{{ isset($getOutbyId) ? $getOutbyId->pending_amount : '' }}"
                                                    readonly />
                                                @error('pending_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                           
                                              <div class="form-group">
                                                <label for="name">{{ __('messages.transction_payment_date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="trans_date" class="form-control" id="trans_date"
                                                    placeholder="date" required=""/>
                                                @error('trans_date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                         

                                            <div class="form-group">
                                                <label for="menu">{{__('messages.payment_method')}}</label>
                                                <span class="payment-error" style="color: red">
                                                   *
                                                </span>
                                                <select name="payment_mode" id="payment_mode" class="form-control" required="">
                                                    <option value="">--- Select Payment Mode ---</option>
                                                    <option value="Online"> Online </option>
                                                    <option value="Offline"> Offline </option>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="menu">{{__('messages.payment_status')}}</label>
                                                 <span class="payment-error" style="color: red">
                                                     *
                                                 </span>
                                                <select name="payment_status" id="payment_status" class="form-control" required="">
                                                    <option value="">--- Select Payment Status ---</option>
                                                    <option value="Pending"> Pending </option>
                                                    <option value="Paid"> Paid </option>
                                                </select>
                                               
                                            </div>

                                        @endif

                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary">{{ isset($getOutbyId) ? 'Update' : 'Submit' }}</button>
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
      
        function calculatePendingAmount() {
            let total_amount = $("#amount").val();
            let paid_amount = $("#paid_amount").val();
            let pending_amount = parseInt(total_amount.replace(/,/g , '')) - paid_amount;
            $("#pending_amount").val(pending_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

            
            if(paid_amount > parseInt(total_amount.replace(/,/g , ''))){
                $("#paid-error").text("Amount should be less than or equal to total amount");
            }
            else{
                $("#paid-error").text("");
            }
        }

          function calculatePaidPendingAmount() {
            let total_amount = $("#pending_state").val();
            let paid_amount = $("#paid_amount").val();
            let pending_amount = total_amount - paid_amount;
            $("#pending_amount").val(pending_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

          //  console.log("paid amount"+paid_amount);
           //  console.log("to amount"+total_amount);

            if(parseInt(paid_amount) > parseInt(total_amount)){
                $("#paid-error").text("You already paid some amount then amount should be less than or equal to Pending Amount");
            }
            else{
                $("#paid-error").text("");
            }

            if(pending_amount == 0){
                $("#payment_status").val("Paid").attr("selected","selected");
               // $("#payment_status").attr("disabled","");
            }
            else{
                $("#payment_status").val("Pending").attr("selected","selected");
              //  $("#payment_status").removeAttr("disabled","");
            }
        }

        function validateText(e){
            var key = e.keyCode;
            if ((key >= 33 && key <= 64) || ( key >=91 && key <= 96) || ( key >=123 && key <= 126)) {
                e.preventDefault();
            }
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
                   // console.log(paid_error);
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
