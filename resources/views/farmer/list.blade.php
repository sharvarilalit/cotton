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
                <h1>{{__('messages.farmar_entries')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{__('messages.farmar_entries')}}</li>
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
                        <label><a href="{{route('farmer.add') }}" class="btn btn-success">{{__('messages.add')}}</a></label>


                           <form id="myform" action='{{ route('farmer') }}' method="get"
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
                              

                                <button value="submit" class="btn btn-primary h-25 " id="search"
                                    name="submit">Search</button> &nbsp;&nbsp;
                                <a href="{{ route('farmer') }}" class="btn btn-danger h-25" id="reset"
                                    name="reset">Reset</a>
                            </div>
                        </form>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>{{__('messages.farmar_name')}}</th>
                                    <th>{{__('messages.location')}}</th>
                                    <th>{{__('messages.contact_number')}}</th>
                                    <th>{{__('messages.alternate_contact_number')}}</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($allcolors as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->location}}</td>
                                    <td>{{$item->contact}}</td>
                                    <td>{{$item->alternate_contact}}</td>
                                    <td>
                                        <a href='{{route('farmer.edit',$item->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>
                                    &nbsp;
                                    <a href='{{route('farmer.extra-payment',$item->id)}}' class="btn btn-success btn-sm"><i
                                                class="fa fa-credit-card "></i></a>
                                    &nbsp;
                                    <a href='{{route('farmer.extra-list',$item->id)}}' class="btn btn-warning btn-sm"><i
                                                class="fa fa-eye"></i></a>
                                    &nbsp;
                                    <a onclick="return confirm('Are you sure?')" href="{{route('farmer.delete',$item->id)}}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    &nbsp;
                                     <a href='{{route('farmer.pdf',$item->id)}}' class="btn btn-dark btn-sm" target="_black"><i class="fas fa-file-pdf"></i></a>
                                    
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
