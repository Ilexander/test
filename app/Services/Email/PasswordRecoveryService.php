<?php

namespace App\Services\Email;

class PasswordRecoveryService extends EmailService
{
    private string $recoveryPasswordLink;

    public function __construct(string $recoveryPasswordLink)
    {
        $this->recoveryPasswordLink = $recoveryPasswordLink;
    }

    public function formData()
    {
        $this->subject = $this->formSubject('recovery');
        $this->subject = str_replace('{website_name}', config('app.name'), $this->subject);

        $this->content = $this->formContent('recovery-tarea');
        $this->content = str_replace('{recovery_password_link}', $this->recoveryPasswordLink, $this->content);
    }
}
