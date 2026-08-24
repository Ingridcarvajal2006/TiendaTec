<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
class SendEmails extends Command
{
    protected $signature = 'email:send {user}';
    protected $description = 'Send an email to a user';

    public function handle()
    {
        $user = $this->argument('user');
        // Lógica para enviar correo
        $this->info("Email sent to {$user}");
    }
}

