<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CountJobsEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public int $jobs_count;

    public function __construct(int $jobs_count)
    {
        $this->jobs_count = $jobs_count;

    }



    public function broadcastOn(): array
    {
        return [
            new Channel('channel-count-jobs'),
        ];
    }


}
