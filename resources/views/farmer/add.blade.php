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
                                                    required="" onkeypress="validateText(event)" maxlength="100" />
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
                                                    required="" onkeypress="validateText(event)" maxlength="20" />
                                                @error('location')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Contact Number') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="tel" name="contact" class="form-control" id="contact"
                                                    placeholder="Contact"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->contact : '' }}"
                                                    required="" maxlength="15" onkeypress="validatePhone(event)"/>
                                                <span id="contact-error" style="color: red"></span>

                                                @error('contact')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Alternate Contact Number') }} </label>
                                                <input type="tel" name="alternate_contact" class="form-control" id="alternate_contact"
                                                    placeholder="Alternate Contact"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->alternate_contact : '' }}"
                                                      maxlength="15" onkeypress="validatePhone(event)"/>
                                                 <span id="alcontact-error" style="color: red"></span>
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
                        minlength:10,
                        maxlength:15
                    },
                    alternate_contact :{
                        minlength:10,
                        maxlength:15
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
    </script>
@endsection
