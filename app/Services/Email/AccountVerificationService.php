<?php

namespace App\Services\Email;

class AccountVerificationService extends EmailService
{
    private string $activationLink;

    public function __construct(string $activationLink)
    {
        $this->activationLink = $activationLink;
    }

    public function formData()
    {
        $this->subject = $this->formSubject('subject-new');
        $this->subject = str_replace('{website_name}', config('app.name'), $this->subject);

        $this->content = $this->formContent('subject-new-tarea');
        $this->content = str_replace('{website_name}', config('app.name'), $this->content);
        $this->content = str_replace('{user_firstname}', $this->user->first_name, $this->content);
        $this->content = str_replace('{activation_link}', $this->activationLink, $this->content);
    }
}
