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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('messages.farmar')}}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.add')}}</li>
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

                                <form id="myform" action='{{ route('salary.store') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getfarmerbyId) ? $getfarmerbyId->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('messages.username') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="name" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Name"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->name : '' }}"
                                                    required=""  />
                                                @error('name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="payment_date" class="form-control" id="payment_date"
                                                    placeholder="date" required=""
                                                    value="{{ isset($getfarmerbyId) ? date('Y-m-d',strtotime($getfarmerbyId->payment_date)) : '' }}"  {{ isset($getfarmerbyId) ? 'readonly' : '' }}/>
                                                @error('date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('messages.amount') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="number" name="amount" class="form-control" id="contact"
                                                    placeholder="Amount"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->amount : '' }}"
                                                    required="" />
                                                <span id="contact-error" style="color: red"></span>

                                                @error('contact')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

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

                                            <div class="form-group transaction">
                                                <label for="menu">{{__('messages.tansaction_number')}}</label>
                                                <span class="payment-error" style="color: red">
                                                    {{ isset($getfarmerbyId) ? '*' : '' }}
                                                </span>
                                                <input type="text" name="tansaction_number" class="form-control" id="tansaction_number"
                                                    placeholder="Transaction Number"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->tansaction_number : '' }}"
                                                    required="" />

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
        function validateText(e){
            var key = e.keyCode;
            if ((key >= 33 && key <= 64) || ( key >=91 && key <= 96) || ( key >=123 && key <= 126)) {
                e.preventDefault();
            }
        }
        function validatePhone(e){
            var key = e.keyCode;
            if (!(key >= 48 && key <= 57)) {
                e.preventDefault();
            }
        }
    </script>
    <script type="text/javascript">

        $(document).ready(function(){

        $('#countrylist').change(function(e){
        // Your event handler
        });

        // And now fire change event when the DOM is ready
        $('#countrylist').trigger('change');
        });

        $(function() {

            $('.transaction').hide();

            $('#myform').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    payment_date: {
                        required: true,
                    },
                    payment_mode: {
                        required: true,
                    },
                    tansaction_number :{
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
                submitHandler:function(element){
                   
                    let contact_no = $('#contact').val();
                    var alter_no = $('#alternate_contact').val();                   
                    var contact_pattern = /^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/;
                   
                    if(contact_no.match(contact_pattern) || (alter_no !=" " && alter_no.match(contact_pattern))){
                        $('#contact-error').text(" ");
                        $('#alcontact-error').text(" ");
                       return true;
                    }
                    else{
                        if(alter_no != "") {
                            $('#contact-error').text("Please enter valid Contact No") ;
                            $('#alcontact-error').text("Please enter valid Contact No");          
                        }else{
                         
                          $('#contact-error').text("Please enter valid Contact No");
                        }
                      
                        return false;
                    }
                   
                }
            });
            
            
        });

        $('#payment_mode').change(function(){
               var val = $(this).val();
                $('.transaction').hide();
                if(val == 'Online'){
                    $('.transaction').show();
                }
            })

            $('#payment_mode').trigger('change');


    </script>
@endsection
