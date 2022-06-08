<?php

namespace App\Services\Email;

use App\Mail\DefaultMail;
use App\Mail\PasswordResetMail;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

abstract class EmailService
{
    protected string $subject;
    protected string $content;

    protected User $user;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function sendMail()
    {
        Mail::to($this->user)->send(new DefaultMail($this->subject, $this->content));
    }

    protected function formSubject(string $subjectFiledName)
    {
        $mailSetting = Settings::query()
            ->where('page_name', 'mail_settings')
            ->where('field_name',$subjectFiledName)
            ->get()
            ->first()
            ->toArray();

        return $mailSetting['field_value'] ?? '';
    }

    protected function formContent(string $subjectFiledName)
    {
        $mailSetting = Settings::query()
            ->where('page_name', 'mail_settings')
            ->where('field_name',$subjectFiledName)
            ->get()
            ->first()
            ->toArray();

        return $mailSetting['field_value'] ?? '';
    }

    abstract public function formData();
}
