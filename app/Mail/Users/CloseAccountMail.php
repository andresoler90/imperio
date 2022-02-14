<?php

namespace App\Mail\Users;

use App\Models\UserMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CloseAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var UserMembership
     */
    public $userMembership;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserMembership $userMembership)
    {
        $this->userMembership = $userMembership;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.users.closeaccount');
    }
}
