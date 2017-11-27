<div class="col-md-12">
   <div class="">
        <div class="">
         <ul class="list-unstyled msg_list">
          @php $comments = $student->stage_comment->where('stage_type',$type) @endphp
            @forelse($comments as $comment)
            <li>
               <a>
               <span>
               <span></span>
               <span class="time">{{$comment->created_at->diffForHumans()}}</span>
               </span>
               <span class="message">
              {{$comment->comment or ''}}
               </span>
               </a>
            </li>
            @empty
            @endforelse
         </ul>
            <div class="clearfix">&nbsp;</div>
            @if($href == '0')
            <form action="{{url('student/stage/'.$student->id)}}" method="post" class="form-horizontal">
                {{csrf_field()}}
                 {{ method_field('PUT') }}
                <input type="hidden" name="type_id" value="{{$type}}">
                <input type="hidden" name="check" value="{{$check}}">
                <input type="hidden" name="field" value="{{$field}}">
                @if($suggest)
                  <input type="hidden" name="suggest" value="{{$suggest}}">
                @endif
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea name="comments" class="form-control" rows="5"></textarea>
                    <p class="text-danger comments_e"></p>
                </div>  
            </form>
            @endif
      </div>
   </div>
</div>
<div class="clearfix"></div>