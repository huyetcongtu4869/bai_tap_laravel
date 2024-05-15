<?php 
if (!function_exists('sendMail')) {
 function sendMail($name, $email)
{
    Mail::send('layouts.email', compact('name', 'email'), function ($email) use ($name, $email) {
        $email->subject('gửi mail');
        $email->to($email, $name);
    });
}}