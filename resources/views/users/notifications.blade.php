@extends('layouts.app')

@section('content')
        <div class="card">
            <div class="card-header">Notifications</div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($notifications as $notification)
                    <li class="list-group-item">
                    @if($notification->type === 'Forum\Notifications\NewReplyAdded')
                        A new reply was added to your discussion
                        <strong>"{{ $notification->data['discussion']['slug'] }}"</strong>
                        <a href="{{ route('discussions.show', $notification->data['discussion']['slug'])  }}" class="btn btn-sm btn-info float-right">View Discussion</a>
                    @endif

                    @if($notification->type === 'Forum\Notifications\ReplyMarkedAsBestReply')

                    Your reply to the discussion <strong>"{{ $notification->data['discussion']['title'] }}"</strong> was marked as best reply.
                    <a href="{{ route('discussions.show', $notification->data['discussion']['title'])  }}" class="btn btn-sm btn-info float-right">View Discussion</a>
                    @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
@endsection
