<div class="card-header">{{ $discussion->author->name }}
    <span class="float-right"><a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success">View</a></span>
</div>