@extends('layouts.master')
@section('content')
@section('title')
Truck Charges Entries
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Truck Charges Entries</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Truck Charges Entries</li>
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
                        <label><a href="{{route('truck.charges.add') }}" class="btn btn-success">Add</a></label>
                         <form id="myform" action='{{ route('truck.charges') }}' method="get"
                        >
                            <div class="row">
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
                                     
                                    <input type="date" name="filter_date" class="form-control" id="filter_date"
                                    placeholder="date" 
                                    value="{{ !empty(request()->get("filter_date")) ? date('Y-m-d',strtotime(request()->get("filter_date"))) : ''}}" />
                                </div>
                                <button value="submit" class="btn btn-primary h-25 " id="search"
                                    name="submit">Search</button> &nbsp;&nbsp;
                                <a href="{{ route('flog') }}" class="btn btn-danger h-25" id="reset"
                                    name="reset">Reset</a>
                            </div>
                        </form>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Truck Number</th>
                                    <th>Date</th>
                                    <th>Village Price Rate</th>
                                    <th>Vehicle Cost</th>
                                    <th>Labour Cost</th>
                                    <th>Village Commission</th>
                                    <th>Route Charges</th>
                                    <th>Vehicle Fillingout Charges</th>
                                    <th>Angadi and Return Person Charges</th>
                                    <th>Total Charges Amount</th>
                                    <th>Jingping Amount</th>
                                    <th>Total Amount </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($allcolors as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->trucks->truck_no}}</td>
                                     <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                    <td>{{number_format($item->village_charges)}}</td>
                                    <td>{{number_format($item->vehicle_charges)}}</td>
                                    <td>{{number_format($item->labor_charges)}}</td>
                                    <td>{{number_format($item->village_commision)}}</td> 
                                    <td>{{number_format($item->route_charges)}}</td>
                                    <td>{{number_format($item->vehicle_filling_out_charges)}}</td>
                                    <td>{{number_format($item->angadi_return_person_charges)}}</td> 
                                    <td>{{number_format($item->total_charges_amount)}}</td>
                                    <td>{{number_format($item->jingping_amount)}}</td>
                                    <td>{{number_format($item->total_amount)}}</td>
                                    <td><a href='{{route('truck.charges.edit',$item->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>&nbsp;<a onclick="return confirm('Are you sure?')" href="{{route('truck.charges.delete',$item->id)}}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                </tbody>
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
