<!DOCTYPE html>
<html>
<head>
    <title>Cosmica Challan</title>
   

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <style>
    	.imgeLogo{
    		height: 120px;
        
    		width: 600px;
    	}
   
   		.headerDiv{
   			border-bottom: 1.2px solid #33aee9;
    		padding-bottom: 10px;
   		}
   		.companyInfo{
   			text-align: right;
   		}
   		.invoiceTitle{
   			font-size: 22px;
   		}
   		.invoiceContent{
   			text-align: right;
   		}
   		.bodyDiv{
   			/*border-bottom: 1.2px solid #33aee9;*/
    		padding-bottom: 10px;
    		

   		}
   		.tablethrow{
   			color: #33aee9;
   		}
   		.itemDiv{
   			margin-top: 1.5em;
   		}
   		.totalText{
   			color: black;
   			font-family: bold;
   		}
   		thead {
   			border-top: 1.2px solid #33aee9;

   		}
   		tfoot{
   			border-bottom: 1.2px solid #33aee9;
    		padding-bottom: 10px;

   		}
   		tfoot tr th{
   			color: black;
   			font-family: bold;
   		}
   		hr{
   			border: 0.5px solid #33aee9;
   		}
    </style>
</head>

<body>


	<div class="container-fluid">
 		<div class="row"> 
        <div class="col-md-12 headerDiv">

            <div class="col-md-7 companyLogo" >
                <img src="https://schoolbusgps.in/inventory/images/cosmicalogo.png" style="margin-top: 10px;">
            </div>

            <div class="col-md-5 companyInfo">

            	<p class="text">ORIGINAL FOR RECIPIENT </p>

                <b style="font-size: 20px;">COSMICA TELEMATICS PVT LTD</b>
                <p>407,SuratWala Mark Plazo, Hinjawadi,
                Pune<br>
                Sports : 9067227722 Email: sales@cosmicagps.com<br>
               <!--  sales@cosmicagps.com<br> -->
                GSTIN: 27AAICC2838H1ZK<br>
                CIN: U72900PN2019PTC185518</p>
                
            </div>
            
        </div> <!-- //md12 -->

        <div class="col-md-12 bodyDiv" style="margin-bottom: 15px !important;">

        	<div class="col-md-6" style="float: left;">
        		<h4 class="invoiceTitle"><b>CHALLAN TO</b></h4>
        		<b style="font-size: 15px;">{{ $challanINFO->name }}</b>
        		<p>{{ $challanINFO->address }}<br>
        			Contact: {{ $challanINFO->mobile }}<br>
        			{{ $challanINFO->email }}<br>
        		</p>
        	</div>

        	<div class="col-md-6  invoiceContent">
        		
        		<h4 class="invoiceTitle"><b>CHALLAN NO {{ $challanINFO->id }}</b></h4>
				<p>DATE {{  date('d-m-Y',strtotime($challanINFO->created_at)) }}<br>
				DUE DATE {{  date('d-m-Y', strtotime($challanINFO->created_at. ' + 15 days')) }}<br>
				TERMS Net 15
			    </p>
        	</div>
            
        </div> <!-- //md12 -->
        	<br>
        <div class="col-md-12 itemDiv">
        	<table class="table table-striped">
    			<thead>
    				<tr class="tablethrow" >
	    				<th>Sr No.</th>
	    				<th>Item Type</th>
	    				<th>Item</th>
              <th>Quantity</th>
	    				<th>Price</th>
    			    </tr>
    			</thead>
    			<tbody >
    				@php 
    				$counter=1;
    				@endphp
    				@foreach($challanItems as $value)
    					<tr>
	    					<td>{{ $counter++ }}</td>
	    					<td>{{ $value->item_type }}</td>
	    					<td>{{ $value->items }}</td>
                <td>{{ $value->quantity }}</td>
	    					<td>{{ $value->price }}</td>
    					</tr>
    				@endforeach
    			<!-- </tbody>
    			<tfoot> -->
    			
    				<tr >
    					<th  style="text-align: right; "  colspan="4">SUBTOTAL</td>
    					<th>{{ $challanINFO->total }}</td>
    				</tr>

    				<tr >
    					<th  style="text-align: right; "  colspan="4">GST Percentage</td>
    					<th>{{ $challanINFO->gst }}%</td>
    				</tr>

    				<tr >
    					<th style="text-align: right; "  colspan="4">Total</td>
    					<th>@php if($challanINFO->total != 0){ echo $withGst = $challanINFO->total+$challanINFO->total*0.18;  }else{ echo $challanINFO->total;  }@endphp </td>
    				</tr>
    			</tbody>


    		</table>
        </div>


        <div class="col-md-12" >
        	<p style="text-align: left; float: left;">
        		<b>Bank Details</b>
	        	<b>Bank Name:</b><span class="text"> HDFC BANK </span><br>
	        	<b>Name:</b> <span  class="text">COSMICA TELEMATICS PRIVATE LIMITED </span><br>
	        	<b>A/C Number:</b><span  class="text"> 50200043064432  </sapn><br>
	        	<b>Account Type:</b><span  class="text"> CURRENT </span><br>
	        	<b>IFSC Code:</b><span  class="text"> HDFC0000052</span>
        	</p>

        	<p style="text-align: right;">
        		<b>SUBTOTAL  {{ $challanINFO->total }}</b><br>
	        	<b>CGST @ 18%</b><br>
	        	<b>TOTAL @php if($challanINFO->total != 0){ echo $withGst = $challanINFO->total+$challanINFO->total*0.18;  }else{ echo $challanINFO->total; }@endphp</b> <br>
	        	<b>BALANCE DUE INR  @php if($challanINFO->total != 0){ echo $withGst = $challanINFO->total+$challanINFO->total*0.18;  }else{ echo $challanINFO->total;  }@endphp</b>
        	</p>

        </div>

        <hr class="hrClass">
        <div class="col-md-12 text-align-left" >
	        <ol type="1" style="font-size: 11px;">
			  <li>No exchange of goods/service once ordered</li>
			  <li >Prices may subjected to change if required.</li>
			  <li>GPS Tracker Warranty is 1 year which starts from date of installation</li>
			  <li>Installation charges of device are at actual extra based on city, location et</li>
			</ol>
		</div>
      
    <hr class="hrClass">
    <footer>
       <p style="font-size: 11px;"><strong>NOTE: </strong> This is a computer generated invoice and hence no signature require.</p>
    </footer>

    </div><!-- /row-->
  </div><!-- /contener-fuid -->


	


 
      
<script>
   window.print();
</script>

</body>
</html>