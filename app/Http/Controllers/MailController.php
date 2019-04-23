<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 3/7/2019
 * Time: 10:44 AM
 */

namespace App\Http\Controllers;

use App\Mail\QuoteEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;

class MailController extends Controller
{

    public function send(Request $request) {

        $name = $request->name ?? "";
        $email = $request->email ?? "";
        $subject = $request->subject ?? "";
        $message = $request->message ?? "";

        $this->sendEmail($subject, $name, $email, $message);
    }

    public function sendQuote(Request $request) {

        $name = $request->name ?? "";
        $email = $request->email ?? "";
        $phone = $request->phone ?? "";
        $message = $request->message ?? "";
        if($request->hasFile('file') && !empty($request->file('file'))) {
            $attachments = $request->file('file');
            $this->sendQuoteEmail('Request a Free Quote - '.$phone, $name, $email, $message, $phone, $attachments);
        }
        else {
            $this->sendEmail('Request a Free Quote', $name, $email, $message);
        }
    }

    //send email
    public function sendEmail($subject, $fromName, $fromEmail, $message) {
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new MyEmail($subject, $fromName, $fromEmail, $message));
    }

    //send email
    public function sendQuoteEmail($subject, $fromName, $fromEmail, $message, $phone, $attachments) {
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new QuoteEmail($subject, $fromName, $fromEmail, $message, $phone, $attachments));
    }
}