<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 3/6/2019
 * Time: 3:26 PM
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyEmail extends Mailable {

    use Queueable,
        SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $message;

    public function __construct($subject, $name, $email, $message)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }


    //build the message.
    public function build() {
        return $this->subject($this->subject)->view('urban-email')->with('data', [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message]);
    }
}