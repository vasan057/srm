<div class="panel panel-default">
    <div class="panel-heading">
        <div class="col-md-4">
            
        <h3 class="panel-title">Referred Commision List</h3>
        </div>
        <div class="col-md-4">
            
        <h3 class="panel-title">{{$title or ''}}</h3>
        </div>
        <div class="col-md-4">
            
        <h3 class="panel-title">Referred Student Count: {{count($referrals)}}</h3>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">  
        <div class="row">
            <div class="col-md-12">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>SNo.</th>
                          <th>Student Name</th>
                          <th>Referred Date</th>
                          <th>Referral Prize</th>
                                    <th>Prize Details</th>
                                    <th>Prize issued on</th>
                                    <th>Action</th>
                                    
                        </tr>
                    </thead>
                    <tbody>
                        @php $i =1; @endphp
                        @forelse($referrals as $referral)
                       
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$referral->student->first_name or ''}} {{$referral->student->last_name or ''}}</td>
                            @php $date = '-'; if(isset($referral->created_at) && $referral->created_at){ $date = date('d-m-Y',strtotime($referral->created_at)); } @endphp
                            <td>{{$date}}</td>
                            <td>{{$referral->commision->referral_prize}}</td>
                             <td>{{$referral->commision->referral_gift_voucher or ''}}{{$referral->commision->referral_prize_amount or ''}}</td>
                           <td>{{ isset($referral->commision->date) ? 'Prize issued on '.date('d-m-Y',strtotime($referral->commision->date)) : 'Prize not issued'}}</td>
                            

                              <td><button class="btn btn-success btn-xs edit-btn" data-id="{{$referral->id}}" data-url="{{url('student/referral-detail/'.$referral->id)}}">View/ edit prize</button></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No record found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
           