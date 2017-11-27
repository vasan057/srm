<div class="col-md-12">
   <div class="">
        <div class="">
         <ul class="list-unstyled msg_list">
            @forelse($student->followup as $follow)
            <li>
               <a>
               <span>
               <span></span>
               <span class="time">{{ date('d/m/Y',strtotime($follow->remind_time))}}-{{$follow->created_at->diffForHumans()}}</span>
               </span>
               <span class="message">
              {{$follow->comments or ''}}
               </span>
               </a>
            </li>
            @empty
            @endforelse
         </ul>
            <div class="clearfix">&nbsp;</div>
            <form action="{{url('student/followup')}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="student_id" value="{{$student->id}}">
                <div class="form-group">
                    <label for="remind_date">Remind Date</label>
                    <input type="text" name="remind_date" id="remind_date" class="form-control">
                    <p class="text-danger remind_date_e"></p>
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea name="comments" class="form-control" rows="5"></textarea>
                    <p class="text-danger comments_e"></p>
                </div>  
            </form>
      </div>
   </div>
</div>
<div class="clearfix"></div>