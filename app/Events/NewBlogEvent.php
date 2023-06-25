<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewBlogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $uuid_model;
    public $link;
    public $name;
    public $email;
    public $type;
    public $title;

    public $date;
    /**
     * Create a new event instance.
     */
    public function __construct($uuid_model,$link,$name,$email,$type,$title,$date)
    {
        $this->uuid_model = $uuid_model;
        $this->link = $link;
        $this->name = $name;
        $this->email = $email;
        $this->title = $title;
        $this->type = $type;
        $this->date = date("Y-m-d h:i:s",strtotime($date));


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastOn()
    {
        return ['new-blog'];
    }
    public function broadcastAs(){
        return 'new-blog-event';
    }
}
