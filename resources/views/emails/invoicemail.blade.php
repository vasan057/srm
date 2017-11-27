
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <style>
    @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 5px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
  width: 20%
}

#logo img {
  height: 90px;
}

#company {
  /* float: right; */
  /* text-align: right; */
  margin-left:50%; 
  width: 100%;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
  width: 40%;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  width:100%;
  margin-left: 25%;
}

#invoice h1 {
  color: #0087C3;
  font-size: 1.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table.table {
  width: 95%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 5px;
}

table.table th,
table.table td {
  padding: 5px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: bold;
}

table.table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table.table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 3px 3px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  /* white-space: nowrap;  */
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}
table.address td{
    padding: 5px;
}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}

    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo" >
        <img src="{{url('public/images/logos/kandel-logo.png')}}" width="200">
      </div>
      <div id="company">
        <h2 class="name">Kandel Consultant</h2>
        <div>{{$template->building_no or ''}},{{$template->street_name or ''}}</div>
        <div> {{$template->suburb or ''}} - {{$template->post_code or ''}},</div>
        <div>{{$template->state  or ''}}</div>
        <div> {{$template->phone or ''}}</div>
        <div><a href="mailto:admin@kandelconsultant.com">admin@kandelconsultant.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{$invoice->institute->institute_name or ''}}</h2>
          <div class="address">{{$invoice->institute->university_address or ''}}</div>
          <div class="address"><a href="mailto:{{$invoice->institute->email_id or ''}}">{{$invoice->institute->email_id or ''}}</a></div>
        </div>
        <div id="invoice">
          <h1>Tax Invoice</h1>
          <div class="date">Payment Date: {{ date('d/m/Y')}}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0" class="table">
        <thead>
          <tr>
            <th class="unit">Student name</th>
            <th class="unit">From Date</th>
            <th class="unit">To Date</th>
            <th class="unit">Amount</th>
            <th class="unit">Consultancy %</th>
            <th class="unit">Sub Total </th>
            <th class="unit">GST</th>
            <th class="unit">Grand Total</th>
          </tr>
        </thead>
        <tbody>
            @php $subtotal = 0; $gst = 0; $total = 0; @endphp
            @foreach($invoice->selfInstitute as $institute)
          <tr>
                <td class="desc">{{$institute->student->first_name or ''}} {{$institute->student->last_name or ''}}</td>
                <td class="">{{$institute->from_date or ''}}</td>
                <td class="">{{$institute->to_date or 0}}</td>
                <td class=""> {{$institute->amount or 0}}</td>
                <td class="">{{$institute->consult_percentage or 0}}</td>
                <td class="">{{$institute->sub_total or 0}}</td>
                <td class="">{{$institute->gst or ''}}</td>
                <td class="">{{$institute->grand_total}}</td>
                @php 
                    $subtotal = $institute->sub_total + $subtotal; 
                    $gst = $institute->sub_total*($institute->gst / 100) + $gst; 
                    $total = $subtotal + $gst;
                @endphp
          </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td colspan="3">Subtotal Amount</td>
            <td>{{$subtotal or ''}}</td>
          </tr>
          <tr>
            <td colspan="4"></td>
            <td colspan="3">GST</td>
            <td>{{$gst or 0}}</td>
          </tr>
          <tr>
            <td colspan="4"></td>
            <td colspan="3">Grand total</td>
            <td>{{$total or ''}}</td>
          </tr>
        </tfoot>
      </table>
      <!-- <div id="thanks">Thank you!</div> -->
      <br>
      <br>
      <div id="notices">
            <table border="1" cellspacing="0" cellpadding="0" width="30%" class="address">
                <tr>
                    <td colspan="2" align="center">Bank Details</td>
                </tr>
                <tr>
                    <td align="left">Bank Name</td>
                    <td>{{$template->bank_name}}</td>
                </tr>
                <tr>
                    <td align="left">Account Name</td>
                    <td>{{$template->ac_name or ''}}</td>
                </tr>
                <tr>
                    <td align="left">BSB Number</td>
                    <td>{{$template->bsb_name}}</td>
                </tr>
                <tr>
                    <td align="left">Account No</td>
                    <td>{{$template->ac_number}}</td>
                </tr>
               
            </table>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>