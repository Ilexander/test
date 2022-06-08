<?php

namespace App\Services\Ticket\TicketMessage;

use App\Interfaces\Repositories\TicketInterface;
use App\Models\TicketMessage;
use App\Repositories\Ticket\TicketMessageRepository;
use Illuminate\Support\ServiceProvider;

class TicketMessageServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('ticketMessageService', function($app) {
            return new TicketMessageService(
                $app->make('App\Interfaces\Repositories\TicketMessageInterface'),
                $app->make('App\Interfaces\Repositories\TicketInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\TicketMessageInterface', function($app) {
            return new TicketMessageRepository(new TicketMessage());
        });
    }
}