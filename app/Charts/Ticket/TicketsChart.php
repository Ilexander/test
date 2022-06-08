<?php

namespace App\Charts\Ticket;

use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Ticket;
use App\Services\Ticket\TicketFacade;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TicketsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $all = new TicketAllRequest();
        $all->merge([
            'start_date' => date('Y-m-d',strtotime("-6 day")),
            'end_date'   => date('Y-m-d')
        ]);
        $tickets = TicketFacade::getAllTickets($all);

        $result = [
            Ticket::OPEN_STATUS     => 0,
            Ticket::PROCESS_STATUS  => 0,
            Ticket::CLOSE_STATUS    => 0,
        ];

        /** @var Ticket $ticket */
        foreach ($tickets as $ticket) {
            if (in_array($ticket->status, [
                Ticket::PROCESS_STATUS,
                Ticket::WAIT_FOR_ADMIN_ANSWER,
                Ticket::WAIT_FOR_USER_ANSWER])
            ) {
                $result[Ticket::PROCESS_STATUS]++;
            } else {
                $result[$ticket->status]++;
            }
        }

        return $this->chart->pieChart()
            ->setTitle('Recent Tickets')
            ->addData([$result[Ticket::OPEN_STATUS], $result[Ticket::PROCESS_STATUS], $result[Ticket::CLOSE_STATUS]])
            ->setLabels(['New', 'Pending', 'Closed']);
    }
}
