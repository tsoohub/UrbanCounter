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
    public $attachPath;

    public function __construct($subject, $name, $email, $message, $phone, $attachPath)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->attachPath = $attachPath;
        $this->phone = $phone;
    }


    //build the message.
    public function build() {

        // attach the files to mail if exists
        if(!empty($this->attachPath)) {
            for($i = 0; $i < sizeof($this->attachPath); $i++){
                $this->attach($this->attachPath[$i]->getRealPath(), [
                    'as' => $this->attachPath[$i]->getClientOriginalName(),
                    'mime' => $this->attachPath[$i]->getMimeType()
                ]);
            }
        }

        return $this->subject($this->subject)->view('urban-email')->with('data', [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message]);
    }
}