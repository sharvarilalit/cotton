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
                <h1>Profit Loss</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Profit Loss</li>
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
                                    <th>Truck Number</th>
                                    <th>Date</th>
                                    <th>Truck Amount</th>
                                    <th>Market Amount</th>
                                    <th>Total Profit/Loss</th>
                                    <th>P/L</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($profit_data as $key=>$item)
                            
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item['truck_no']}}</td>
                                    <td>{{date('d-m-Y',strtotime($item['date']))}}</td>
                                    <td>{{ number_format($item['truck_total_amount'])}}</td>
                                    <td>{{number_format($item['market_total_amount'])}}</td>
                                    <td><b>{{ number_format($item['profit_loss']) }}</b></td>
                                    <td class="{{ $item['result_pl'] }}">{{ $item['result_pl'] }}</td>                                
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
