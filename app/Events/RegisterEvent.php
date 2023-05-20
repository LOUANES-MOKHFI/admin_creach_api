<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $uuid_model;
    public $link;
    public $model;
    public $date;
    /**
     * Create a new event instance.
     */
    public function __construct($uuid_model,$link,$model,$date)
    {
        $this->uuid_model = $uuid_model;
        $this->date = date("Y-m-d h:i:s",strtotime($date));
        $this->link = $link;
        $this->model = $model;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastOn()
    {
        return ['new-user-register'];
    }
    public function broadcastAs(){
        return 'new-user-event';
    }
}
