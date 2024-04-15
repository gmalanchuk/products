<?php

namespace App\Jobs;

use App\Mail\ProductCreatedMail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProductCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Product $product;
    protected User $user;

    public function __construct($product, $user)
    {

        $this->product = $product;
        $this->user = $user;
    }

    public function handle(): void
    {
        $email = new ProductCreatedMail($this->product, $this->user);
        Mail::to($this->user->email)->send($email);
    }
}
