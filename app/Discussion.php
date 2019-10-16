<?php

namespace Forum;
use Illuminate\Database\Eloquent\Model;
use Forum\Notifications\ReplyMarkedAsBestReply;
class Discussion extends Model
{
    protected $fillable = ['user_id', 'slug', 'title', 'content', 'channel_id', 'reply_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /** Overrides route model minding. Instead of finding the id, it will use the slug*/
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannels($builder)
    {
        if(request()->query('channel'))
        {
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if($channel)
            {
                return $builder->where('channel_id', $channel->id);
            }
            return $builder;
        }

        return $builder;
    }

    public function markAsBestReply(Reply $reply)
    {
         $this->update([
            'reply_id' => $reply->id
        ]);
        
        if($reply->owner->id === $this->author->id)
        {
            return;
        }
        $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
    }
}
