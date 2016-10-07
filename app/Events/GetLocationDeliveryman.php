<?php

namespace Delivery\Events;

use Delivery\Models\Geo;
use Delivery\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class GetLocationDeliveryman implements ShouldBroadcast;
{
    use InteractsWithSockets, SerializesModels;

    public $geo;

    private $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Geo $geo, Order $order)
    {
        $this->geo = $geo;
        $this->model = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [$this->model->hash];
    }
}
