  <div style="margin-top: 10px; text-align: center;"><h1>アップロード</h1></div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
      
    {!! Form::open(['url' => '/upload/exec', 'method' => 'post', 'files' => true]) !!}
    <div class="form-group">
        <div class="image">
            {!! Form::label('file', 'アップロードする画像', ['class' => 'control-label']) !!}
            {!! Form::file('file') !!}
        </div>
        <div class="cost">
            {!! Form::label('file', '投資金額', ['class' => 'control-label']) !!}
            {!! Form::text('cost', '0') !!}円
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit('アップロード', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}
  </div>