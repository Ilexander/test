<?php

namespace App\Services\Email;

class MailToSubscriberService extends EmailService
{

    public function formData(string $subject = '', string $content = '')
    {
        $this->subject = $subject;
        $this->content = $content;
    }
}
