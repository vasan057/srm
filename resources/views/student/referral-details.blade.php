<form action="{{url('student/referral-detail/'.$referral->id)}}" class="form-horizontal" method="post">
	{{csrf_field()}}
	<div class="form-group">
        <label class="col-md-3 control-label">Student Identity *</label>
        <div class="col-md-9">
            <label class="check"><input type="radio" class="prize_type" name="prize_type" value="amount" @if($type == 'amount') checked @endif/> Amount &nbsp;&nbsp;</label>
            <label class="check"><input type="radio" class="prize_type" name="prize_type" value="gift" @if($type == 'gift') checked @endif/> Gift &nbsp;&nbsp;</label>
            <p class="text-danger prize_type_e"></p>
        </div>
    </div>
    <div class="form-group amount_divs" @if($type != 'amount') style="display: none;" @endif>
        <label class="col-md-3 control-label"></label>
        <div class="col-md-9">
        	<input type="text" name="commision_amount" class="form-control" placeholder="Commision Amount" value="{{$amount or ''}}">
            <p class="text-danger commision_amount_e"></p>
        </div>
    </div> 
    <div class="form-group gift_divs" @if($type != 'gift') style="display: none;" @endif >
        <label class="col-md-3 control-label"></label>
        <div class="col-md-9">
        	<input type="text" name="gift" class="form-control" placeholder="Ex:Voucher or gift" value="{{$gift or ''}}">
            <p class="text-danger gift_e"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Status *</label>
        <div class="col-md-9">
            <label class="check"><input type="radio" class="iradio" name="status" value="0" @if($flag === 0) checked @endif/> Not Paid (OR) Price Not Issued &nbsp;&nbsp;</label>
            <label class="check"><input type="radio" class="iradio" name="status" value="1" @if($flag === 1) checked @endif/> Paid (OR) Prize Issued &nbsp;&nbsp;</label>
            <p class="text-danger status_e"></p>
        </div>
    </div>
</form>