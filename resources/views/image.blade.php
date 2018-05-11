  @if($photo_info)
  <div class="image-text">
    <div class="photo-image">
      <a href="{{ asset('storage/images/' . $photo_info->name) }}">
        <img src="{{ asset('storage/images/' . $photo_info->name) }}">
      </a>
    </div>
  </div>
  @endif
