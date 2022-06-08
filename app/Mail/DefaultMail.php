<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $mailSubject;
    private string $mailContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        string $mailSubject,
        string $mailContent
    ) {
        $this->mailSubject = $mailSubject;
        $this->mailContent = $mailContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->mailSubject)
            ->view('emails.generic-mail', [
                'content' => $this->mailContent
            ]);
    }
}
