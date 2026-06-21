<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MenuCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $menu;

    /**
     * Create a new event instance.
     */
    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    /**
     * Channel name (must match JS)
     */
    public function broadcastOn()
    {
        return new Channel('menu-channel');
    }

    /**
     * Event name (must match JS)
     */
    public function broadcastAs()
    {
        return 'menu.created';
    }

    /**
     * Data send to frontend
     */
    public function broadcastWith()
    {
        return [
            'menu' => $this->menu
        ];
    }
}
