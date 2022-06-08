<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepository;
use Illuminate\Support\ServiceProvider;

class TicketServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('ticketService', function($app) {
            return new TicketService(
                $app->make('App\Interfaces\Repositories\TicketInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\TicketInterface', function($app) {
            return new TicketRepository(new Ticket());
        });
    }
}