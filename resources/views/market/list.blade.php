@extends('layouts.master')
@section('content')
@section('title')
Market Entries
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('messages.market_entries')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{__('messages.market_entries')}}</li>
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
                        <label><a href="{{route('market.add') }}" class="btn btn-success">Add</a></label>

                        <form id="myform" action='{{ route('market') }}' method="get"
                        >
                            <div class="row">
                                <div class="form-group col-md-3">
                                      <!-- <label> </label> -->
                                    <select type="text" name="truck_id" class="form-control" id="truck_id"
                                       >
                                        <option value="">Select Truck</option>
                                        @foreach ($truck as $cats)
                                            <option value="{{$cats->id}}" @if($cats->id==request()->get("truck_id")) selected @endif>{{ $cats->truck_no }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                      <!-- <label>From</label> -->
                                    <input type="date" name="from_date" class="form-control" id="from_date"
                                    placeholder="From Date" 
                                    value="{{ !empty(request()->get("from_date")) ? date('Y-m-d',strtotime(request()->get("from_date"))) : ''}}" />
                                </div>

                                <div class="form-group col-md-3">
                                      <!-- <label>To</label> -->
                                    <input type="date" name="to_date" class="form-control" id="to_date"
                                    placeholder="To Date" 
                                    value="{{ !empty(request()->get("to_date")) ? date('Y-m-d',strtotime(request()->get("to_date"))) : ''}}" />
                                </div>

                                <button value="submit" class="btn btn-primary h-25 " id="search"
                                    name="submit">Search</button> &nbsp;&nbsp;
                                <a href="{{ route('market') }}" class="btn btn-danger h-25" id="reset"
                                    name="reset">Reset</a>
                            </div>
                        </form>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>{{__('messages.market')}}</th>
                                    <th>{{__('messages.truck_number')}}</th>
                                    <th>{{__('messages.truck_trip')}}</th>
                                    <th>{{__('messages.product')}}</th>
                                    <th>{{__('messages.market')}} {{__('messages.location')}}</th>
                                    <th>{{__('messages.date')}}</th>
                                    <th>{{__('messages.cotton_Weight')}}</th>
                                    <th>{{__('messages.market_price')}}</th>
                                    <th>{{__('messages.total_amount')}}</th>
                                    <th>{{__('messages.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($allcolors as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->market_name}}</td>
                                    <td>{{$item->trucks->truck_no}}</td>
                                     <td>{{$item->trip}}</td>
                                    <td>{{$item->product  == 1 ? __('messages.cotton'): __('messages.wheat')}}</td>            
                                    <td>{{$item->market_location}}</td>
                                    <td>{{date('d-m-Y',strtotime($item->date))}}</td>
                                     <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->market_price)}}</td>
                                    <td>{{number_format($item->total_amount)}}</td>
                                    <td><a href='{{route('market.edit',$item->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>&nbsp;<a onclick="return confirm('Are you sure?')" href="{{route('market.delete',$item->id)}}"
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
