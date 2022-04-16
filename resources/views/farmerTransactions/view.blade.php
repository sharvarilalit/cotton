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
                <h1>Farmer Transaction Histroy</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Farmer Transaction Histroy</li>
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

                  
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Farmer Name</th>
                                    <th>Product</th>
                                    <th>Paid Amount</th>
                                    <th>Date</th>
                                    <th>Payment status</th>
                                    <th>Payment mode</th>
                                    <th>Sent By</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $total_amount = 0 ; ?>
                                @forelse($farmer as $key=>$item)
                                     <?php $total_amount += $item->paid_amount ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->fname }}</td>
                                        <td>{{ $item->product == 1 ? 'Cotton': 'Wheat'}}</td>
                                        <td>{{ number_format($item->paid_amount) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->users->name}}</td>
                                    </tr>

                                @endforeach
                                   
                                </tbody>

                        </table>
                        <p style="margin-top:20px"><b>Total Paid Amount : {{ number_format($total_amount) }}/-</b></p>
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
