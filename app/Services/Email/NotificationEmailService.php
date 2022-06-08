<?php

namespace App\Services\Email;

class NotificationEmailService extends EmailService
{
    public function formData()
    {
        $this->subject = $this->formSubject('notify-welcome');
        $this->subject = str_replace('{website_name}', config('app.name'), $this->subject);

        $this->content = $this->formContent('notify-tarea');
        $this->content = str_replace('{website_name}', config('app.name'), $this->content);
        $this->content = str_replace('{user_firstname}', $this->user->first_name, $this->content);
        $this->content = str_replace('{user_lastname}', $this->user->last_name, $this->content);
        $this->content = str_replace('{user_email}', $this->user->email, $this->content);
        $this->content = str_replace('{user_timezone}', $this->user->timezone, $this->content);
    }
}
