<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 3/7/2019
 * Time: 3:07 PM
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuoteEmail extends Mailable {

    use Queueable,
        SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $message;
    public $phone;
    public $attachment;

    public function __construct($subject, $name, $email, $message, $phone, $attachment)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->attachment = $attachment;
        $this->phone = $phone;
    }


    //build the message.
    public function build() {
        return $this->attach($this->attachment->getRealPath(), [
            'as' => $this->attachment->getClientOriginalName(),
            'mime' => $this->attachment->getMimeType()
            ])->subject($this->subject)->view('urban-email')->with('data', [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message]);
    }
}