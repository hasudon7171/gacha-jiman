<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

$(function() {
  $('input[type="checkbox"]').change(function(e) {

    e.preventDefault();
    $("#favorite").submit();
    return false;
  });
});
</script>

　@if($photo_info)
  <div class="image-text">
    <div class="photo-image">
      <a href="{{ asset('storage/images/' . $photo_info->name) }}">
        <img src="{{ asset('storage/images/' . $photo_info->name) }}">
      </a>
    </div>
    @if($my_comment_info)
    {{ $my_comment_info->comment }}
    @endif
    
    <div class="other_comment">
        @if($other_comment_info)
            @foreach($other_comment_info as $other_comment)
            {{ $other_comment->comment }}
            @endforeach
        @endif
    </div>
    
    @if($is_mine)
    
    <!-- 本人コメント -->
    {!! Form::open(['url' => '/detail/edit', 'method' => 'post']) !!}
    {{Form::hidden('is_mine',  $is_mine)}}
    {{Form::hidden('id', $photo_info->id)}}
    <div class="my_comment">
        {!! Form::label('my_comment', 'コメント', ['class' => 'control-label']) !!}
        {!! Form::textarea('my_comment', null, ['rows' => '2', 'cols' => '25']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('更新', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}
    
    @elseif($is_login)
    
    <!-- favoriteチェックボックス -->
    <form action="" method="post" name="favorite" id="favorite">
    <div>
        <input type="checkbox" name="favorite" value="1">お気に入り
    </div>
    </form>
    
    <!-- 他人コメント -->
    {!! Form::open(['url' => '/detail/edit', 'method' => 'post']) !!}
    {{Form::hidden('is_mine',  $is_mine)}}
    {{Form::hidden('id', $photo_info->id)}}
    <div class="other_comment">
        {!! Form::label('other_comment', 'コメント', ['class' => 'control-label']) !!}
        {!! Form::textarea('other_comment', null, ['rows' => '2', 'cols' => '25']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('更新', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}
    
    @else
    @endif
  </div>
  @endif
