<form action="{{url('invoice/'.$invoice->id)}}" method="post">
    {{csrf_field()}}
    {{ method_field('PUT') }}
<div class="row">
        <div class="form-group">
            <label class="col-md-3 control-label">Student Name </label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="studentName" id="studentName" value="{{$invoice->student->first_name or ''}} {{$invoice->student->last_name or ''}}" readonly="readOnly">
                </div>                            
                <p class="text-danger studentName_e"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">University Name </label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="universityName" id="universityName" value="{{$invoice->institute->institute_name or ''}}" readonly="readOnly">
                </div>                            
                <p class="text-danger universityName_e"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Course Name </label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="courseName" id="courseName" value="{{$invoice->suggest->course_name or ''}}" readonly="readOnly">
                </div>                            
                <p class="text-danger courseName_e"></p>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Amount * </label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="amount" id="amount" value="{{$invoice->amount}}">
                </div>   
                <p class="text-danger amount_e"></p>
                </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Consultancy Percentage *</label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="consultancyPercentage" id="consultancyPercentage" value="{{$invoice->consult_percentage}}">
                </div> 
                <p class="text-danger consultancyPercentage_e"></p>
            </div>
            
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Sub Total *</label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="totalAmount" id="totalAmount" value="{{$invoice->sub_total}}" readonly="readOnly">
                </div>
                <p class="text-danger totalAmount_e"></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">GST *</label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="gst" id="gst" value="{{$invoice->gst}}" >
                </div>
                <p class="text-danger gst_e"></p>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Grand Total *</label>
            <div class="col-md-9"> 
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                    <input type="text" class="form-control" name="grandTotal" id="grandTotal" value="{{$invoice->grand_total}}" readonly>
                </div>
                <p class="text-danger grandTotal_e"></p>
            </div>
        </div>
        
        
        <div class="form-group">
            <label class="col-md-3 control-label">From Date * </label>
            <div class="col-md-9"> 
                <div class="input-group"> 
                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                    <input type="text" class="form-control datepicker" name="fromDate" id="fromDate" readonly="readOnly" autocomplete="on" value="{{$invoice->from_date}}">
                </div> 
                <p class="text-danger fromDate_e"></p>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">To Date *</label>
            <div class="col-md-9"> 
                <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                    <input type="text" class="form-control datepicker" name="toDate" id="toDate" readonly="readOnly" autocomplete="on" value="{{$invoice->to_date}}">
                </div>   
                <p class="text-danger toDate_e"></p>
            </div>
            
        </div>
     </div>
    </form>
     <style>
         .ui-datepicker{
    z-index: 1050!important;
}
     </style>