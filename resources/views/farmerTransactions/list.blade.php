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
                <h1>{{__('messages.farmer_details')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{__('messages.farmer_details')}}</li>
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
                                <button value="submit" class="btn btn-primary h-25 " id="search"
                                    name="submit">Search</button> &nbsp;&nbsp;
                                <a href="{{ route('ftransaction') }}" class="btn btn-danger h-25" id="reset"
                                    name="reset">Reset</a>&nbsp;&nbsp;
                                <button type="button" value="export" class="btn btn-info h-25 " id="export"
                                    name="submit">Export</button>
            
                               
                            </div>
                        </form>
                      
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <!-- <th>Transaction Number</th> -->
                                    <th>{{__('messages.farmar_name')}}</th>
                                    <th>{{__('messages.product')}}</th>
                                    <th>{{__('messages.farmar')}} {{__('messages.location')}}</th>
                                    <th>{{__('messages.truck_number')}}</th>
                                    <th>{{__('messages.trips')}}</th>
                                    <th>{{__('messages.date')}}</th>
                                    <!-- <th>Cotton Weight Qintal</th>
                                    <th>Cotton Weight Kg</th> -->
                                    <th>{{__('messages.cotton_Weight')}}</th>
                                    <th>{{__('messages.price')}}</th>
                                    <th>{{__('messages.total_amount')}}</th>
                                    <th>{{__('messages.paid_amount')}} </th>
                                    <th>{{__('messages.pending_amount')}}</th>
                                    <!-- <th>Payment Status</th>
                                    <th>Payment Mode</th> -->
                                    <th>{{__('messages.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allcolors as $key=>$item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                       <!--  <td>{{ $item->transaction_number }}</td> -->
                                        <td>{{ $item->farmers->name }}</td>
                                        <td>{{ $item->product == 1 ? __('messages.cotton'): __('messages.wheat')}}</td>
                                        <td>{{ $item->farmers->location }}</td>
                                        <td>{{ $item->trucks->truck_no }}</td>
                                        <td>{{ $item->trip }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                        <td>{{ $item->weight }}</td>
                                        <td>{{ number_format($item->price) }}</td>
                                        <td>{{ number_format($item->total_amount) }}</td>
                                        <td>{{ number_format($item->paid_amount) }}</td>
                                        <td>{{ number_format($item->pending_amount) }}</td>
                                        <td>
                                            <?php 
                                                if( $item->pending_amount != 0  ) { ?>
                                                <a href='{{ route('ftransaction.edit', $item->id) }}'
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                           <?php } ?>
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

        $(document).on('click','#export',function(){       
            var farmer_id = $('#farmer_id').val();
            var truck_id = $('#truck_id').val();        
            var date = $('#date').val();     
               window.open("ftransaction.export?farmer_id="+ farmer_id+"&truck_id=" + truck_id + "&date=" + date +"", '_blank');
        });
    });
</script>
@endsection
