@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="page-content-wrap">
        <div class="row">
            <!-- search bar -->
            <div class="panel panel-default">
                <div class="x_title">
                    <div class="col-md-6">
                        <h3><small>Referred commision report </small>  </h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">                                                                        
                    <div class="row">
                        <div class="col-md-12 alert alert-danger error-msg" style="display:none"></div>   
                       <form action="" method="get" onsubmit="return validate(this)">
                        
                        <div class="form-group col-md-3 has-feedback">
                            <label for="">From</label>
                             <span class="fa fa-calendar form-control-feedback right"></span>
                            <input type="text" class="form-control" name="from" id="from" placeholder="From date" value="{{$_GET['from'] or ''}}" readonly>
                        </div>
                        <div class="form-group col-md-3 has-feedback">
                            <label for="to">To</label>
                             <span class="fa fa-calendar form-control-feedback right"></span>
                            <input type="text" name="to" class="form-control" id="to" placeholder="To date" value="{{$_GET['to'] or ''}}" readonly>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info form-control">Search</button>
                        </div>
                       </form>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="x_content">
                    
                        <table id="datatable-fixed-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Referral Person Name</th>
                                    <th>Referred Student Name</th>
                                    <th>Referred Method</th>
                                    <th>Referral Prize</th>
                                    <th>Prize Details</th>
                                    <th>Prize issued on</th>
                                    <th>Referral Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @forelse($report as $list)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->refStudent->first_name or ''}}{{$list->others->name or ''}}</td>
                                        <td>{{$list->student->first_name or ''}}{{$list->student->last_name or ''}}</td>
                                        <td>{{$list->referral_method or ''}}</td>
                                        <td>{{$list->commision->referral_prize or '-'}}</td>
                                        <td>{{$list->commision->referral_gift_voucher or ''}}{{$list->commision->referral_prize_amount or ''}}</td>
                                        <td>{{ isset($list->commision->date) ? 'Prize issued on '.date('d-m-Y',strtotime($list->commision->date)) : 'Prize not issued'}}</td>
                                        <td>{{date('d-m-Y',strtotime($list->created_at))}}</td>
                                    </tr>
                                @empty
                                 <tr>
                           <td colspan="12">Data empty</td>
                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$report->appends($_GET)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
@endpush
@push('script')
<script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
<script>
    $(function(){
         $('#from').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear : true
            }).on( "change", function() {
              $('#to').datepicker( "option", "minDate", getDate( this ) );
        });
        $('#to').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear : true
            }).on( "change", function() {
                $('#from').datepicker( "option", "maxDate", getDate( this ) );
        });
    });
    function getDate( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( 'dd-mm-yy', element.value );
    } catch( error ) {
      date = null;
    }

    return date;
  }

  function validate(from){
    console.log(from);
    var data = $(from).serializeArray();
    var count = 0;
    $.each(data,function(k,v){
        if(v.value != '') count++;
    });
    if(count<2){
        alert("Please select both the date");
       return false;
    }
  }
</script>
@endpush
    
