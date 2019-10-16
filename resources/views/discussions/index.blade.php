@extends('layouts.app')

@section('content')
   @foreach($discussions as $discussion)
        <div class="card mb-5">
        @include('partials.discussion-header')
            <div class="card-body">
                <h5 class="text-center"><strong><a href="{{ route('discussions.show', $discussion->slug) }}">{{ $discussion->title }}</a></strong></h5>
            </div>
        </div>

   @endforeach
   {{ $discussions->appends(['channel' => request()->query('channel') ])->links() }}
@endsection
