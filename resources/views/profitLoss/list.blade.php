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
<<<<<<< HEAD
                <h1>Profit Loss</h1>
=======
                <h1>{{__('messages.profit_loss_report')}}</h1>
>>>>>>> d5dcf15... new changes
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
<<<<<<< HEAD
                    <li class="breadcrumb-item active">Profit Loss</li>
=======
                    <li class="breadcrumb-item active">{{__('messages.profit_loss_report')}}</li>
>>>>>>> d5dcf15... new changes
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
                      
                    
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>{{__('messages.truck_number')}}</th>
                                    <th>{{__('messages.truck_trip')}}</th>
                                    <th>{{__('messages.product')}}</th>
                                    <th>{{__('messages.date')}}</th>
                                    <th>{{__('messages.truck_amount')}}</th>
                                    <th>{{__('messages.market_amount')}}</th>
                                    <th>{{__('messages.total_profit_loss')}}</th>
                                    <th>P/L</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($profit_data as $key=>$item)
                            
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item['truck_no']}}</td>
                                    <td>{{$item['trip']}}</td>
                                    <td>{{$item['product']  == 1 ? __('messages.cotton'): __('messages.wheat')}}</td>
                                    <td>{{date('d-m-Y',strtotime($item['date']))}}</td>
                                    <td>{{ number_format($item['truck_total_amount'])}}</td>
                                    <td>{{number_format($item['market_total_amount'])}}</td>
                                    <td><b>{{ number_format($item['profit_loss']) }}</b></td>
                                    <td class="{{ strtolower($item['result_pl']) }}">{{ $item['result_pl'] }}</td>                                
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
