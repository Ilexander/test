<?php

namespace App\Services\Email;

class PaymentNotificationService extends EmailService
{
    public function formData()
    {
        $this->subject = $this->formSubject('payment');
        $this->subject = str_replace('{website_name}', config('app.name'), $this->subject);

        $this->content = $this->formContent('payment-tarea');
        $this->content = str_replace('{user_firstname}', $this->user->first_name, $this->content);
    }
}
