  <div style="margin-top: 80px; text-align: center;"></div>
    <div class="col-md-4 col-md-offset-4">
      <h1>List</h1>
      <ul class="thumbnail clearfix">
      @foreach ($photo_list as $photo)
      
        <li>
          <a href="{{ action('ImageController@detail', ['id' => $photo->id])}}" data-lity="data-lity">
            <img src="{{ asset('storage/images/' . $photo->name) }}" width="250px" />
          </a>
        </li>
      
      @endforeach
      </ul>
    </div>