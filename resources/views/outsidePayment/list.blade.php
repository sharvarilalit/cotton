@extends('layouts.master')
@section('content')
@section('title')
    Outside Entries
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Outside Transaction Entries</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Outside Transaction Entries</li>
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
                        <label><a href="{{ route('outsidep.add') }}" class="btn btn-success">Add</a></label>

                        <form id="myform" action='{{ route('outsidep') }}' method="get"
                        >
                            <div class="row">
                              
                                <div class="form-group col-md-3">
                                    <input type="date" name="date" class="form-control" id="date"
                                    placeholder="date" 
                                    value="{{ !empty(request()->get("date")) ? date('Y-m-d',strtotime(request()->get("date"))) : ''}}" />
                                </div>
                                <div class="form-group col-md-3">
                                    <button value="submit" class="btn btn-primary  " id="search"
                                        name="submit">Search</button> &nbsp;&nbsp;
                                    <a href="{{ route('ftransaction') }}" class="btn btn-danger " id="reset"
                                        name="reset">Reset</a>
                                </div>
                            </div>
                        </form>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                   <!--  <th>Transaction Number</th> -->
                                    <th>Agent Name</th>
                                   <!--  <th>Farmer Location</th> -->
                                    <!-- <th>Truck Number</th> -->
                                    <th>Date</th>
                                    <!-- <th>Cotton Weight Qintal</th>
                                    <th>Cotton Weight Kg</th> -->
                                    <!-- <th>Cotton Weight</th> -->
                                    <th>Amount</th>
                                    <!-- <th>Total Amount</th> -->
                                    <th>Paid Amount</th>
                                    <th>Pending Amount</th>
                                    <!-- <th>Payment Status</th>
                                    <th>Payment Mode</th> -->
                                    <th>Action</th>
                                </tr>
                                  @forelse($outside_payment as $key=>$item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>                        
                                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                      
                                        <td>{{ number_format($item->amount) }}</td>   
                                        <td>{{ number_format($item->paid_amount) }}</td>
                                        <td>{{ number_format($item->pending_amount) }}</td>
                                  
                                        <td>
                                            <?php 
                                                if( $item->pending_amount != 0  ) { ?>
                                                <a href='{{ route('outsidep.edit', $item->id) }}'
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                           <?php } ?>
                                         
                                                <a href='{{ route('outsidep.export') }}'
                                                    class="btn btn-success btn-sm"><i class="fas fa-download"></i></a>&nbsp;
                                                 <a
                                                    href="{{ route('outsidep.view', $item->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <a
                                                onclick="return confirm('Are you sure?')"
                                                href="{{ route('outsidep.delete', $item->id) }}"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                
                                        </td>
                                    </tr>
                                @endforeach
                                </tfoot>

                            </thead>
                            <tbody>
                               
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
