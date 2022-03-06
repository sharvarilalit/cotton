@extends('layouts.master')
@section('content')
@section('title')
Farmer Extra Entries
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('messages.farmer_extra_entries')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{__('messages.farmer_extra_entries')}}</li>
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

                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                   @endif
                   
                    <!-- /.card-header -->
                    <div class="card-body">
                       <!--  -->
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>{{__('messages.username')}}</th>
                                    <th>{{__('messages.amount')}}</th>
                                    <th>{{__('messages.payment_mode')}}</th>
                                    <th>{{__('messages.payment_date')}}</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $total = 0; ?>
                              @forelse($far_payment as $key=>$item)
                                    <?php $total += $item->amount; ?>
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{number_format($item->amount)}}</td>
                                    <td>{{$item->payment_mode==1?'Online':'Offline'}}</td>
                                    <td>{{ date('d-m-Y',strtotime($item->payment_date))}}</td>
                                    <td>
                                        <a onclick="return confirm('Are you sure?')" href="{{route('farmer.extra-delete',$item->id)}}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                       <p style="margin-top:20px;text-indent: 20px"><b> Total Extra Amount : {{ number_format($total) }}/-</b></p>
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
