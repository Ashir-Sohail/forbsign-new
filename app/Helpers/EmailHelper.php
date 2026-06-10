<?php
// app/Helpers/EmailHelper.php

namespace App\Helpers;

use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    public static function sendDynamicEmail($to, $templateTitle, array $data)
    {
        $template = EmailTemplate::where('title', $templateTitle)->first();

        if (!$template) {
            throw new \Exception("Email template '$templateTitle' not found.");
        }

        $body = self::replaceVariables($template->body, $data);
        $subject = ucfirst(str_replace('_', ' ', $templateTitle));

        Mail::send([], [], function ($message) use ($to, $subject, $body) {
            $message->to($to)
                ->subject($subject)
                ->html($body);
        });
    }

    private static function replaceVariables($template, array $data)
    {
        foreach ($data as $key => $value) {
            $template = str_replace("#{$key}", $value, $template);
        }
        return $template;
    }
}