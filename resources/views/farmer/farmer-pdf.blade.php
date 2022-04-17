<!DOCTYPE html>
<html>
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>farmer</title>
    <style type="text/css" media="all">
    	*{ font-family: sans-serif};

		table, th, td {
		  border: 1px solid black;
		  border-collapse: collapse;
		}
		th, td {
		  padding: 25px;
		}
    </style>
</head>
<body>
    <h1 style="text-align: center;color:red">Farmer History</h1>
   	<div class="">

   			<p><b>Name  :</b> {{ $farmer[0]->name}}</p>
   			<p><b>Location  :</b> {{ $farmer[0]->location}}</p>
   			<p><b>Contact Number  :</b> {{ $farmer[0]->contact}}</p>
   			<p><b>Alternate Contact Number  :</b> {{ $farmer[0]->alternate_contact}}</p>

	 <!--  	<table id="" class="table table-bordered table-hover">
            <tbody>

				<tr><td><th>Name</th> </td><td>{{ $farmer[0]->name}}</td> </tr>  
				<tr><td><th>Location</th> </td><td>{{ $farmer[0]->location}}</td> </tr>  
				<tr><td><th>Contact Number</th> </td><td>{{ $farmer[0]->contact}}</td> </tr>  
				<tr><td><th>Alternate Contact Number</th> </td><td>{{ $farmer[0]->alternate_contact}}</td> </tr>  
                           
          	</tbody>
        </table> -->
   	</div>

   	<br><br>
   	<div class="col-md-3">
   		<p style="color:red;font-size: 60px;font-weight: bold;">Product Details : </p>
   		  <table  class="table table-bordered table-hover">
            <thead>
	            <tr>
	                <th>S.L</th>
	                <th>Transaction No</th>	         
	                <th>Product</th>
	                <th>Truck No</th>
	                <th>Trips</th>
	                <th>Date</th>
	                <th>Weight</th>
	                <th>Price</th>
	                <th>Total Amount</th>
	                <th>Paid Amount</th>
	                <th>Pending Amount</th>
	            </tr>
	        </thead>
        <tbody>
            @forelse($farmer_product as $key=>$item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product == 1 ? 'Cotton': 'Wheat'}}</td>
                    <td>{{ $item->trucks->truck_no }}</td>
                    <td>{{ $item->trip }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                    <td>{{ $item->weight }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ number_format($item->total_amount) }}</td>
                    <td>{{ number_format($item->paid_amount) }}</td>
                    <td>{{ number_format($item->pending_amount) }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
   	</div>
  	<br><br>
   	<div>
   		<p  style="color:red;font-size: 60px;font-weight: bold;">Extra Payment Details : </p>
     <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $total = 0; ?>
                              @forelse($far_payment as $key=>$item)
                                    <?php $total += $item->amount; ?>
                                <tr>
                                    <td>{{$key+1}}</td>
                                   
                                    <td>{{number_format($item->amount)}}</td>
                                    <td>{{$item->payment_mode==1?'Online':'Offline'}}</td>
                                    <td>{{ date('d-m-Y',strtotime($item->payment_date))}}</td>
                                  
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                       <p style="margin-top:20px;text-indent: 20px"><b> Total Extra Amount : {{ number_format($total) }}/-</b></p>
   	</div>
  	<br><br>
   	<div>
   		<h1  style="color:red;font-size: 60px;font-weight: bold;">Payment Details :</h1>
   		 <table>
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Transaction No</th>
                                    <th>Farmer Name </th>
                                    <th>Paid Amount </th>
                                    <th>Date</th>
                                    <th>Payment Status </th>
                                    <th>Payment Mode</th>
                                    <th>Sent By</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @forelse($farmer_pay_log as $key=>$item)
                                    
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->transaction_id }}</td>
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
</body>
</html>