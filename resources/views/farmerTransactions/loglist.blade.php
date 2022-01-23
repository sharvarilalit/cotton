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
                <h1>Farmer Log Entries</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Farmer Log Entries</li>
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

                        <form id="myform" action='{{ route('flog') }}' method="get"
                        >
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <select type="text" name="farmer_id" class="form-control" id="farmer_id"
                                       >
                                        <option value="">Filter By Farmer</option>
                                        @foreach ($flist as $cats)
                                            <option value={{ $cats->id }} @if($cats->id==request()->get("farmer_id")) selected @endif>{{ $cats->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="date" name="filter_date" class="form-control" id="filter_date"
                                    placeholder="date" 
                                    value="{{ !empty(request()->get("filter_date")) ? date('Y-m-d',strtotime(request()->get("filter_date"))) : ''}}" />
                                </div>
                                <button value="submit" class="btn btn-primary  " id="search"
                                    name="submit">Search</button> &nbsp;&nbsp;
                                <a href="{{ route('flog') }}" class="btn btn-danger " id="reset"
                                    name="reset">Reset</a>
                            </div>
                        </form>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Farmer Name</th>
                                    <th>Paid Amount</th>
                                    <th>Date</th>
                                    <th>Payment status</th>
                                    <th>Payment mode</th>
                                    <th>Sent By</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @forelse($farmer as $key=>$item)
                                    
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->fname }}</td>
                                        <td>{{ number_format($item->paid_amount) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->users->name}}</td>
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
