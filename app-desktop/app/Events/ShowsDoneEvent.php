<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Show;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ShowsDoneEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $path;
    private $keyParam;
   
    public function __construct(string $path, string $keyParam)
    {   
        $this->path = $path;
        $this->keyParam = $keyParam;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('shows-channel.'.$this->path);
    }

    public function broadcastAs(): string
    {
        return 'shows-app';
    }

    public function broadcastWith(): array
    {

        Show::create(['name' => Redis::get($this->path.$this->keyParam), 'category' => $this->path]);

        return ['show' => Redis::get($this->path.$this->keyParam), 'category' => '/'.$this->path]; 
        
    }

    public function broadcastWhen(): bool 
    {

        $keys = Redis::keys('*');

        if (count($keys) > 0) {
            return true;
        } else return false;
                   
    }

}
