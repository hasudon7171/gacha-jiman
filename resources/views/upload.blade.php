  <div style="margin-top: 10px; text-align: center;"><h1>アップロード</h1></div>
    @if (session('message'))
    <div class="col-md-8 col-md-offset-2">
        <div class="alert alert-warning">
                {{ session('message') }}
        </div>
    </div>
    @endif
      
    {!! Form::open(['url' => '/detail/store', 'method' => 'post', 'files' => true]) !!}
    <div class="form-group">
        <div class="image">
            {!! Form::label('file', 'アップロードする画像', ['class' => 'control-label']) !!}
            {!! Form::file('file') !!}
        </div>
        <div class="cost">
            {!! Form::label('cost', '投資金額', ['class' => 'control-label']) !!}
            {!! Form::text('cost', '0') !!}円
        </div>
        <div class="myself_comment">
            {!! Form::label('my_comment', 'コメント', ['class' => 'control-label']) !!}
            {!! Form::textarea('myself_comment', null, ['rows' => '2', 'cols' => '25']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit('アップロード', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}
  </div>