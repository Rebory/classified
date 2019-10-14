<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return WelcomeUser
     */
    public function build()
    {
        return $this->from('reborysgh@gmail.com')
            ->subject('New account created.')
            ->view('email_templates.welcome-role')
            ->with('data', $this->data);
    }

}//class

