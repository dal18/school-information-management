<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email? : The email address to send to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration by sending a test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?: $this->ask('Enter email address to send test email to');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address!');
            return 1;
        }

        $this->info('Sending test email to: ' . $email);
        $this->info('Using mailer: ' . config('mail.default'));
        $this->info('SMTP Host: ' . config('mail.mailers.smtp.host'));
        $this->info('SMTP Port: ' . config('mail.mailers.smtp.port'));

        try {
            Mail::raw('This is a test email from School Information Management System. If you received this, your email configuration is working correctly!', function ($message) use ($email) {
                $message->to($email)
                    ->subject('Test Email - SIMS');
            });

            $this->info('✓ Test email sent successfully!');
            $this->info('Please check the inbox for: ' . $email);
            return 0;

        } catch (\Exception $e) {
            $this->error('✗ Failed to send email!');
            $this->error('Error: ' . $e->getMessage());
            $this->newLine();
            $this->warn('Common fixes:');
            $this->line('1. Check your .env file has correct MAIL_* settings');
            $this->line('2. For Gmail: Enable "App Passwords" in Google Account settings');
            $this->line('3. Make sure MAIL_MAILER=smtp (not "log")');
            $this->line('4. Verify MAIL_USERNAME and MAIL_PASSWORD are correct');
            return 1;
        }
    }
}
