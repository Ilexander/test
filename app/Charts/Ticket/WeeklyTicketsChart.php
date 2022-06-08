<?php

namespace App\Charts\Ticket;

use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Ticket;
use App\Services\Ticket\TicketFacade;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WeeklyTicketsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $all = new TicketAllRequest();
        $all->merge([
            'start_date' => date('Y-m-d',strtotime("-6 day")),
            'end_date'   => date('Y-m-d')
        ]);
        $tickets = TicketFacade::getAllTickets($all);

        $defaultValues = [
            date('Y-m-d',strtotime("-6 day"))   => 0,
            date('Y-m-d',strtotime("-5 day"))   => 0,
            date('Y-m-d',strtotime("-4 day"))   => 0,
            date('Y-m-d',strtotime("-3 day"))   => 0,
            date('Y-m-d',strtotime("-2 day"))   => 0,
            date('Y-m-d',strtotime("-1 day"))   => 0,
            date('Y-m-d')                                => 0
        ];

        $result = [
            Ticket::OPEN_STATUS     => $defaultValues,
            Ticket::PROCESS_STATUS  => $defaultValues,
            Ticket::CLOSE_STATUS    => $defaultValues,
        ];

        foreach ($tickets as $ticket) {

            $status = $ticket->status;
            if (in_array( $ticket->status, [Ticket::WAIT_FOR_ADMIN_ANSWER, Ticket::WAIT_FOR_USER_ANSWER])) {
                $status = Ticket::PROCESS_STATUS;
            }

            if (isset($result[$status][$ticket->created_at->format("Y-m-d")])) {
                $result[$status][$ticket->created_at->format("Y-m-d")]++;
            } else {
                $result[$status][$ticket->created_at->format("Y-m-d")] = 0;
            }
        }

        $chart = $this->chart->lineChart()
            ->setTitle('Weekly Recent Tickets');

        foreach ($result as $key => $item) {
            $chart->addData($key, [
                $item[date('Y-m-d',strtotime("-6 day"))],
                $item[date('Y-m-d',strtotime("-5 day"))],
                $item[date('Y-m-d',strtotime("-4 day"))],
                $item[date('Y-m-d',strtotime("-3 day"))],
                $item[date('Y-m-d',strtotime("-2 day"))],
                $item[date('Y-m-d',strtotime("-1 day"))],
                $item[date('Y-m-d')],
            ]);
        }

        $chart->setXAxis(array_keys($defaultValues));

        return $chart;
    }
}
