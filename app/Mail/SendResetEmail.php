<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $subject;
    public $link;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $link, $name)
    {
        $this->subject=$subject;
        $this->link=$link;
        $this->name=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_subject=$this->subject;
        $e_link=$this->link;
        $e_name=$this->name;

        $data = array(
            'link' => $e_link,
            'imie' => $e_name
        );
        return $this->from('kursphp@interaktywnie.com')
            ->view('mail.resetPassword')->subject($e_subject)->with($data);
    }
}
