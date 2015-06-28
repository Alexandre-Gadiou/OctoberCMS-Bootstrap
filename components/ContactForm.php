<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Contact Form',
            'description' => 'Contact form'
        ];
    }

    public function defineProperties()
    {
        return [

            'recipient_email' => [
                'title' => 'Recipient Email',
                'description' => 'Email address where emails are sent to',
                'type' => 'string'
            ],
            'email_sent_confirmation' => [
                'title' => 'Email sent',
                'description' => 'Message displayed when email has been successfully sent',
                'default' => 'Email has been successfully sent',
                'type' => 'string'
            ],
            'email_sent_failed' => [
                'title' => 'Email failed',
                'description' => 'Message displayed when email has not been sent',
                'default' => "Error : failed to send email",
                'type' => 'string'
            ],
            'redirect_page' => [
                'title' => 'Redirect page',
                'description' => 'Redirect the user to a url after mail sent (Keep empty if no redirection needed)',
                'type' => 'string'
            ],
            'redirection_time' => [
                'title' => 'Email redirection time',
                'description' => 'Delay in seconds before redirecting (work only if Redirect page filled )',
                'type' => 'string'
            ]
        ];
    }

    public function getProperty($propertyName)
    {
        return $this->property($propertyName);
    }

    public function sendContactForm()
    {
        $is_mail_sent = false;

        // Get data
        $lastname = post('lastname');
        $firstname = post('firstname');
        $email = post('email');
        $subject = post('subject');
        $message_body = post('message');

        $inputs = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'subject' => $subject,
            'message' => $message_body
        ];

        $rules = [
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ];

        $messages = [
            'lastname.required' => 'contactForm.lastname_required',
            'firstname.required' => 'contactForm.firstname_required',
            'email.required' => 'contactForm.email_required',
            'email.email' => 'contactForm.email_invalid',
            'subject.required' => 'contactForm.subject_required',
            'message.required' => 'contactForm.message_required'
        ];

        // Data Validation
        $validator = Validator::make($inputs, $rules, $messages);


        if ($validator->fails())
        {

            $messages = $validator->messages();
            $this->page["inputs"] = $inputs;
            $this->page["messages"] = $messages;
            return;
        }

        $data = compact('firstname', 'lastname', 'email', 'subject', 'message_body');

        $is_mail_sent = Mail::send('algad.bootstrap::mail.contactform.message', $data, function($message) use($firstname, $lastname, $email)
                {
                    $message->from($email, $firstname . " " . $lastname);
                    $message->addReplyTo($email, $lastname . ' ' . $firstname);
                    $message->to($this->getProperty('recipient_email'));
                });


        if ($is_mail_sent)
        {
            $this->page["contact_success_message"] = $this->getProperty('email_sent_confirmation');
        }
        else
        {
            $this->page["contact_error_message"] = $this->getProperty('email_sent_failed');
        }
    }

}
