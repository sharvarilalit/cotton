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
                                                <label for="name">{{ __('Farmer name') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="farmer_id" class="form-control" id="farmer_id" required="">
                                                    <option value="">Select</option>
                                                    @foreach ($farmer as $cats)
                                                        <option
                                                            {{ isset($getfarmerbyId) && $cats->id == $getfarmerbyId->farmer_id ? 'selected' : '' }}
                                                            value={{ $cats->id }}>{{ $cats->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('farmer_id')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name">{{ __('Truck') }} <span
                                                        style='color:red'>*</span></label>
                                                <select type="text" name="truck_id" class="form-control" id="truck_id" required="">
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
                                                <label for="name">{{ __('Date') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    placeholder="date" required=""
                                                    value="{{ isset($getfarmerbyId) ? date('Y-m-d',strtotime($getfarmerbyId->date)) : '' }}" />
                                                @error('date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <div class="form-group">
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
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Quantity') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="quantity" class="form-control" id="quantity"
                                                    placeholder="Quantity" onkeyup="calculateAmount()"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->quantity : '' }}"
                                                    required="" />
                                                @error('quantity')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Price') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="price" class="form-control" id="price"
                                                    placeholder="Price" onkeyup="calculateAmount()"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->price : '' }}"
                                                    required="" />
                                                @error('price')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Total Amount') }} <span
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
                                                <label for="name">{{ __('Paid Amount') }} </label>
                                                <input type="text" name="paid_amount" class="form-control"
                                                    id="paid_amount" placeholder="Paid Amount"
                                                    onkeyup="calculatePendingAmount()"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->paid_amount : '' }}" />
                                                @error('paid_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Pending Amount') }} </label>
                                                <input type="text" name="pending_amount" class="form-control"
                                                    id="pending_amount" placeholder="Paid Amount"
                                                    value="{{ isset($getfarmerbyId) ? $getfarmerbyId->pending_amount : '' }}"
                                                    readonly />
                                                @error('pending_amount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="menu">Payment Mode</label>
                                                <select name="payment_mode" id="payment_mode" class="form-control" required="">
                                                    <option value="">--- Select Payment Mode ---</option>
                                                    <option value="Online" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_mode == 'Online' ? 'selected' : '';
} ?>> Online </option>
                                                    <option value="Offline" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_mode == 'Offline' ? 'selected' : '';
} ?>> Offline </option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="menu">Payment Status</label>
                                                <select name="payment_status" id="payment_status" class="form-control" required="">
                                                    <option value="">--- Select Payment Status ---</option>
                                                    <option value="Pending" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_status == 'Pending' ? 'selected' : '';
} ?>> Pending </option>
                                                    <option value="Paid" <?php if (!empty($getfarmerbyId)) {
    echo $getfarmerbyId->payment_status == 'Paid' ? 'selected' : '';
} ?>> Paid </option>
                                                </select>
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
                    farmer_id: {
                        required: true,
                    },
                    cotton_weight: {
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
                    },
                    payment_status: {
                         required: true,
                    },
                    payment_mode: {
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
