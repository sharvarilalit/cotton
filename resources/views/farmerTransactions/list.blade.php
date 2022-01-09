@extends('layouts.master')
@section('content')
@section('title')
    Farmer Entries
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Farmer Transaction Entries</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Farmer Transaction Entries</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                        <label><a href="{{ route('ftransaction.add') }}" class="btn btn-success">Add</a></label>

                        <form id="myform" action='{{ route('ftransaction') }}' method="get"
                        >
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <select type="text" name="farmer_id" class="form-control" id="farmer_id"
                                       >
                                        <option value="">Filter By Farmer</option>
                                        @foreach ($farmer as $cats)
                                            <option value={{ $cats->id }} @if($cats->id==request()->get("farmer_id")) selected @endif>{{ $cats->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select type="text" name="truck_id" class="form-control" id="truck_id"
                                       >
                                        <option value="">Filter By Truck</option>
                                        @foreach ($truck as $cats)
                                            <option value="{{$cats->id}}" @if($cats->id==request()->get("truck_id")) selected @endif>{{ $cats->truck_no }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <input type="date" name="date" class="form-control" id="date"
                                    placeholder="date" 
                                    value="{{ !empty(request()->get("date")) ? date('Y-m-d',strtotime(request()->get("date"))) : ''}}" />
                                </div>
                                <button value="submit" class="btn btn-primary  " id="search"
                                    name="submit">Search</button> &nbsp;&nbsp;
                                <a href="{{ route('ftransaction') }}" class="btn btn-danger " id="reset"
                                    name="reset">Reset</a>
                            </div>
                        </form>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Farmer Name</th>
                                    <th>Farmer Location</th>
                                    <th>Truck Number</th>
                                    <th>Date</th>
                                    <!-- <th>Cotton Weight Qintal</th>
                                    <th>Cotton Weight Kg</th> -->
                                    <th>Cotton Weight</th>
                                    <th>Price</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Pending Amount</th>
                                    <th>Payment Status</th>
                                    <th>Payment Mode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allcolors as $key=>$item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->farmers->name }}</td>
                                        <td>{{ $item->farmers->location }}</td>
                                        <td>{{ $item->trucks->truck_no }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                      <!--   <td>{{ $item->cotton_weight_qi }}</td>
                                        <td>{{ $item->cotton_weight_kg }}</td> -->
                                         <td>{{ $item->weight }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->total_amount }}</td>
                                        <td>{{ $item->paid_amount }}</td>
                                        <td>{{ $item->pending_amount }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td><a href='{{ route('ftransaction.edit', $item->id) }}'
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                                <a href='{{ route('ftransaction.export') }}'
                                                    class="btn btn-success btn-sm"><i class="fas fa-download"></i></a>&nbsp;
                                                 <a
                                                    href="{{ route('ftransaction.view', $item->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <a
                                                onclick="return confirm('Are you sure?')"
                                                href="{{ route('ftransaction.delete', $item->id) }}"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                
                                        </td>
                                    </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
@section('script')
<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>
@endsection
