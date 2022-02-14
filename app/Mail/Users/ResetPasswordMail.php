<?php

namespace App\Mail\Users;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;
    public $newpassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $newpassword)
    {
        $this->user = $user;
        $this->newpassword = $newpassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->user->email)
            ->view('mails.users.resetpassword');
    }

}
