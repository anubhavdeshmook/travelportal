<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\EmailManager\Entities\EmailTemplate;
use App\Models\Email;

class ManuMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The template instance.
     *
     * @var template
     */
    public $template;

    /**
     * The replacement instance.
     *
     * @var replacement
     */
    public $replacement;
    public $subject;
    public $bodyhtml;
    public $to;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($replacementVars)
    {
        if (!empty($replacementVars['hooksVars'])) {
            foreach ($replacementVars['hooksVars'] as $hook => $var) {
                $replacement['##' . $hook . '##'] = $var;
            }
        }
        $this->template = $replacementVars['template'];
        $this->replacement = $replacement;

        if (isset($replacementVars['subject'])) {
            $this->subject = $replacementVars['subject'];
        }

        if (isset($replacementVars['bodyhtml'])) {
            $this->bodyhtml = $replacementVars['bodyhtml'];
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->buildMessage($this->template);
        if ($message) {
            $subject = $message['subject'];
            $content = $message['message'];
        } else {
            $subject = $this->subject;
            $content = $this->bodyhtml;
        }
        return $this->view('emails.echo')
            ->from(config("get.FROM_EMAIL"), config("get.SYSTEM_APPLICATION_NAME"))
            //->bcc('hanumanprasad.yadav@dotsquares.com', 'Hanuman Yad')
            ->replyTo(config("get.FROM_EMAIL"), config("get.SYSTEM_APPLICATION_NAME"))
            ->subject($subject)
            ->with(['content' => $content]);
    }

    public function buildMessage($email_type = null)
    {
        if (!$email_type) {
            return false;
        }

        $emailTemplate = Email::where('name', $email_type)->first();

        if (empty($emailTemplate)) {
            return false;
        }
        $fullUrl = \App::make('url')->to('/');
        $replacement = $this->replacement;
        /*$default_replacement = [
            '##SYSTEM_APPLICATION_NAME##' => config("get.SYSTEM_APPLICATION_NAME"),
            '##BASE_URL##' => $fullUrl,
            '##//##' => asset('storage/settings/' . config('get.MAIN_LOGO')),
            '##COPYRIGHT_TEXT##' => "Copyright &copy; " . date("Y") . " " . config("get.SYSTEM_APPLICATION_NAME"),
        ];*/
        //$message_body = str_replace('##EMAIL_CONTENT##', $emailTemplate->description, $emailTemplate->email_preference->layout_html);
        //$message_body = str_replace('##EMAIL_FOOTER##', nl2br($emailTemplate->footer_text), $message_body);
        //$message_body = strtr($message_body, $default_replacement);
        
        // print_r($replacement['##EMAIL_VERIFICATION_LINK##']);die;
        // $message_content = 
        
        
        // echo $message_body;die;        
        //$subject = strtr($emailTemplate->subject, $default_replacement);
        // $message_body = '<p>Hello!</p><p>Please click the button below to verify your email address.</p><p><a href="'.$replacement['##EMAIL_VERIFICATION_LINK##'].'">VERIFY MY EMAIL</a></p><p>Or copy and paste the link below.</p><p>'.$replacement['##VERIFICATION_LINK##'].'</p>';
        // echo $message_body;die;
        $message_body = strtr($emailTemplate->description, $replacement);
        $subject = $emailTemplate->subject;
        $subject = strtr($subject, $replacement);
        // echo $subject;die;
        return $message = ['message' => $message_body, 'subject' => $subject];
    }
}
