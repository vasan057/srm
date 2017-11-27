@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Dashboard</a></li>
      <li><a href="{{url('/student')}}">View Student list</a></li>
      <li class="active">Create </li>
    </ol>
    <!-- top tiles -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Student Fees Details - {{$student->first_name or ''}}</h3>
                    </div>
                    <div class="panel-body">  
                        <div class="row">
                            <div class="col-md-6">
                            @php 
                                $suggest = json_encode([]);
                            @endphp
                            @if(isset($student->fees) && $student->fees->balance_amount < 1)
                                <h4>Fees has been paid, please download the fees statements for further details.</h4>
                            @else
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('student/fees/'.$student->id)}}" id="free-form">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Institution Name *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <select class="form-control" name="institution" id="institution">
                                                    
                                                    @if(isset($student->suggest) && count($student->suggest))
                                                        @php 
                                                            $suggest = $student->suggest->toJson();
                                                        @endphp
                                                        @if($student->fees && isset($student->fees->history))
                                                        <option value="{{$student->fees->suggest_id or 1}}">{{$student->fees->suggest->institute_name or 'NA'}}</option>
                                                        @else
                                                            <option value="">Select</option>
                                                            @php $suggest = $student->suggest()->where('flag',1)->get(); @endphp
                                                            @foreach($suggest as $inst)
                                                                <option value="{{$inst->id}}">{{$inst->institute_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    @else
                                                        <option value="">Select</option>
                                                    @endif
                                                    
                                                </select>
                                            </div>
                                            <p class="text-danger institution_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Course Name *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <select name="coursename" id="coursename" class="form-control">
                                                    @if($student->fees && $student->fees->history)
                                                    <option value="{{$student->fees->suggest->course_id or '1'}}">{{$student->fees->suggest->course_name or ''}}</option>
                                                    @else
                                                    <option value="">Select</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <p class="text-danger coursename_e"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Total Fees *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="totalfees" id="totalfees"  placeholder="Total Fees" @if($student->fees) value="{{$student->fees->total_fees}}" readonly @endif />
                                            </div>
                                            <p class="text-danger totalfees_e"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Scholarship </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="scholarship" id="scholarship"  placeholder="Scholarship" @if($student->fees) value="{{$student->fees->scholarship}}" readonly @endif/>
                                            </div>
                                            <p class="text-danger scholarship_e"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Grand Total </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="grandtotal" id="grandtotal"  placeholder="Grand Total" readonly="readonly" @if($student->fees) value="{{$student->fees->grand_total}}" @endif/>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!$student->fees)
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Amount Paid to *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <label class="check"><input type="radio" class="iradio"  name="paidto" id="paidto" value="To Consultancy" /> To Consultancy &nbsp;&nbsp;</label>
                                                <label class="check"><input type="radio" class="iradio"  name="paidto" value="To Institution" /> To Institution &nbsp;&nbsp;</label>
                                            </div>
                                            <p class="text-danger paidto_e"></p>
                                        </div>
                                    </div>
                                    @else
                                        <input type="hidden" name="paidto" value="{{$student->fees->paid_to}}">
                                    @endif
                                    @if($student->fees)
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Previous Amount Paid * </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control"  id="pre_amount" value="{{$student->fees->amount_paid}}"  readonly />
                                            </div>
                                            <p class="text-danger pre_amount_e"></p>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Amount Paid * </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="amountpaid" id="amountpaid"  placeholder="Amount Paid" @if($student->fees) value="{{$student->fees->balance_amount}}" @endif />
                                            </div>
                                            <p class="text-danger amountpaid_e"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Balance Amount </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="balanceamount" id="balanceamount"  placeholder="Balance Amount" readonly="readonly" @if($student->fees) value="0" @endif/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Payment Method *</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <label class="check"><input type="radio" class="iradio"  name="paidby" id="paidby" value="Paid By Cash" /> Paid By Cash &nbsp;&nbsp;</label>
                                                <label class="check"><input type="radio" class="iradio"  name="paidby" value="Net Transfer" /> Net Transfer &nbsp;&nbsp;</label>
                                                <label class="check"><input type="radio" class="iradio"  name="paidby" value="Credit Card" /> Credit Card &nbsp;&nbsp;</label>
                                            </div>
                                            <p class="text-danger paidby_e"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-9">
                                            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <textarea style="width:100%;height:150px;" id="notes" name="notes" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">&nbsp;</label>
                                        <div class="col-md-9">
                                            <div class="input-group"> 
                                                <button type="submit" class="btn btn-info" >Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Fees Statements - PDF</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Student Name</th>
                                                    <th>Last Paid Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                                @if(isset($student->fees) && isset($student->fees->history))
                                                @foreach($student->fees->history as $history)
                                                    <tr>
                                                        <td><?php echo ++$i;?></td>
                                                        <td>{{$student->first_name or ''}}</td>
                                                        <td>{{ date('d/m/Y',strtotime($history->created_at))}}</td>
                                                        <td><a href="{{url('student/fees/'.$history->id.'/download')}}" class="btn btn-xs">Download</a></td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    var suggest = '<?php echo $suggest; ?>';
</script>
<script type="text/javascript" src="{{asset('public/js/student/fees.js?d='.time())}}"></script>
@endpush