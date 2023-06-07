<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class SendDailyEmail extends Command
{
    protected $signature = 'email:send-daily';

    protected $description = 'Send a daily email to a random user with product recommendations';

    public function handle()
    {
        $randomUser = User::inRandomOrder()->first();

        $randomProducts = Product::inRandomOrder()->limit(3)->get();

        $emailContent = "Dear " . $randomUser->name . ",\n\n";
        $emailContent .= "Here are three random products for you:\n\n";

        foreach ($randomProducts as $product) {
            $emailContent .= "- " . $product->name . ": " . $product->description . "\n";
            $emailContent .= "  Link: " . $product->link . "\n\n";
        }

        Mail::raw($emailContent, function ($message) use ($randomUser) {
            $message->to($randomUser->email);
            $message->subject('Your Daily Product Recommendations');
        });

        $this->info('Daily email sent successfully.');
    }
}
