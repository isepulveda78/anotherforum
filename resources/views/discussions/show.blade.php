@extends('layouts.app')

@section('content')
            <div class="card">
                @include('partials.discussion-header')
                 <div class="card-body">
                    <h5 class="text-center"><strong>{{ $discussion->title }}</strong></h5>
                    <hr>
                    {!! $discussion->content !!}
                    @if($discussion->bestReply)
                                    <div class="card bg-success my-5">
                                        <div class="card-header">
                                            Best Reply by {{ $discussion->bestReply->owner->name}}
                                        </div>
                                        <div class="card-body">
                                            {!! $discussion->bestReply->content !!}
                                        </div>
                                    </div>
                    @endif
                </div>
            </div>

            @foreach($discussion->replies()->paginate(3) as $reply)
                <div class="card mt-5">
                    <div class="card-header">
                                <div class="d-flex justify-content-between">
                                <div>
                                    <h5>{{ $reply->owner->name }}</h5>
                                </div>
                                    <div>
                                        @auth 
                                            @if(auth()->user()->id === $discussion->user_id)
                                                <form action="{{ route( 'discussion.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id ]) }}" method="POST"> 
                                                @csrf
                                                    <button type="submit" class="btn btn-info">Best Reply</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                    </div>
      
                    <div class="card-body">
                                <p>{!! $reply->content !!}</p>
                    </div>
                </div>
            @endforeach 

                <div class="mt-5">
                    {{ $discussion->replies()->paginate(3)->links() }}
                </div>

            <div class="card my-5">
                <div class="card-header">
                    Add a reply
                </div>
                @auth
                <div class="card-body">
                    <form action="{{ route('replies.store',  $discussion->slug ) }}" method="Post">
                        @csrf
                        <input type="hidden" name="content" id="content">
                        <trix-editor input="content"></trix-editor>
                        <button type="submit" class="btn btn-success mt-2">Reply</button>
                    </form>
                </div>
                </div>
   
                @else 
                <div class="card-body">
                    <h5 class="text-center"><strong><a href="{{ route('login') }}">Sign in to add to the conversation!</a></strong></h5>
                </div>
            </div>
            @endauth
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection