<?php

namespace Forum\Http\Controllers;

use Auth;
use Forum\Http\Requests\CreateDiscussionRequest;
use Illuminate\Http\Request;
use Forum\Discussion;
use Forum\Reply;
class DiscussionController extends Controller
{
    public function __contstruct()
    {
        $this->middleware('auth', 'verified')->only(['create', 'store']);
    }

    public function index()
    {
        return view('discussions.index', [
            'discussions' => Discussion::filterByChannels()->paginate(5)
        ]);
    }

    public function create()
    {
        return view('discussions.create');
    }

    public function store(CreateDiscussionRequest $request)
    {
        Auth::user()->discussions()->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'content' => $request->content,
            'channel_id' => $request->channel,
        ]);

        session()->flash('success', 'Discussion posted.');

        return redirect()->route('discussions.index');
    }
    public function show(Discussion $discussion)
    {
        return view('discussions.show', [
            'discussion' => $discussion
            ]);
    }

    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);

        session()->flash('success', 'Mark as best reply');

        return redirect()->back();
    }
}
