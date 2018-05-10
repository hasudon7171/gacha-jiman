  <div style="margin-top: 10px; text-align: center;"><h1>アップロード</h1></div>
    @if (session('message') )
          <div class="alert alert-success">{{ session('message') }}</div>
    @endif
      
    {!! Form::open(['url' => '/upload/exec', 'method' => 'post', 'files' => true]) !!}
    <div class="form-group">
    
    {!! Form::label('file', 'image upload', ['class' => 'control-label']) !!}
    {!! Form::file('file') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('アップロード', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}
  </div>