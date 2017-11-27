
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

table {
  width: 95%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 5px;
}

table th,
table td {
  padding: 5px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: bold;
}

table td {
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

table tbody tr:last-child td {
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
        <div>Level 10, 230 Collins Street,</div>
        <div> Melbourne, Victoria - 3000,</div>
        <div>Australia</div>
        <div> 61 425 779 082</div>
        <div><a href="mailto:admin@kandelconsultant.com">admin@kandelconsultant.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{$bill->student->title or ''}} {{ucfirst($bill->student->first_name)}} {{ucfirst($bill->student->last_name)}}</h2>
          <div class="address">{{$bill->student->address or ''}}</div>
          <div class="address"><a href="mailto:{{$bill->student->email_id or ''}}">{{$bill->student->email_id or ''}}</a></div>
        </div>
        <div id="invoice">
          <h1>Fee statement</h1>
          <div class="date">Payment Date: {{ date('d/m/Y',strtotime($bill->created_at))}}</div>
          <div class="date">Payment Method: {{$bill->paid_by or ''}}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="unit">Institution Name</th>
            <th class="unit">Course Name</th>
            <th class="unit">Total Fees</th>
            <th class="unit">Discount</th>
            <th class="unit">Scholarship</th>
            <th class="unit">Grand Total</th>
            <th class="unit">Amount Paid</th>
            <th class="unit">Balance Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
                <td class="desc">{{$bill->suggest->institute_name or ''}}</td>
                <td class="">{{$bill->suggest->course_name or ''}}</td>
                <td class="">{{$bill->total_fees or 0}}</td>
                <td class=""> - </td>
                <td class="">{{$bill->scholarship or 0}}</td>
                <td class="">{{$bill->grand_total or 0}}</td>
                <td class="">{{$bill->amount_paid or ''}}</td>
                <td class="">{{$bill->grand_total - $bill->amount_paid}}</td>
          </tr>
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td colspan="3">Previous payment(s) </td>
            <td>{{$bill->pre_balance or 0}}</td>
          </tr>
          <tr>
            <td colspan="4"></td>
            <td colspan="3">Paid Amount</td>
            <td>{{$bill->amount_paid or ''}}</td>
          </tr>
          <tr>
            <td colspan="4"></td>
            <td colspan="3">Total Paid Amount</td>
            <td>{{sprintf("%.2f",$bill->amount_paid + $bill->pre_balance)}}</td>
          </tr>
          <tr>
            <td colspan="4"></td>
            <td colspan="3">Due Balance</td>
            <td>{{$bill->balance_amount or ''}}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <!-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div> -->
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>