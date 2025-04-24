<div class="row media_list">
    @foreach ($media as $item)
        <div class="col-md-2 mb-3">
            <div class="card">

                <button class="btn btn-sm btn-danger delete-image" data-id="{{ $item->id }}"><i class="bi bi-x-square"></i> Delete</button>

                <div class="ratio ratio-1x1 overflow-hidden">
                    <a href="#" class="media-image mce-content-image" data-title="{{ $item->tag }}" data-filename="{{ asset('storage/'.$item->file_path) }}" title="Click here to insert" >
                        <img src="{{ asset('storage/'.$item->file_path) }}" class="card-img-top img-fluid" alt="Image"/>
                    </a>
                </div>
                <div class="card-body text-center">
                    <input type="text" 
                                            name="tag_{{ $item->id }}"
                                            class="form-control tag-input" 
                                            data-id="{{ $item->id }}" 
                                            value="{{ $item->tag }}" 
                                            placeholder="Edit Tag">
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
 
<div class="row pt-2">
    {!! $media->links() !!}
</div>


