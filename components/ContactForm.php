<?php

namespace Algad\Bootstrap\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Validator;

class ContactForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Bootstrap Contact Form',
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

    public function getOptions()
    {
        return $this->getProperties();
    }

    public function sendContactForm()
    {
        $is_mail_sent = false;

        // Get data
        $lastname = post('lastname');
        $firstname = post('firstname');
        $email = post('email');
        $subject = post('subject');
        $message = post('message');

        $inputs = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
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
            $failed_message = "<p>" . $this->getOptions()['email_sent_failed'] . "</p>";
            $this->page["contact_error_message"] = $failed_message;
        }


        //$is_mail_sent = true;
        if ($is_mail_sent)
        {
            $success_message = "<p>" . $this->getOptions()['email_sent_confirmation'] . "</p>";
            if (!empty($this->getOptions()['redirection_time']))
            {
                $redirect_message = "<p>Vous allez être redirigé vers l'accueil dans  <span id=\"countdown\">" . $this->getOptions()['redirection_time'] . "</span> secondes</p>";
                $this->page["contact_success_message"] = $success_message . $redirect_message;
            }
            else
            {
                $this->page["contact_success_message"] = $success_message;
            }
        }
    }

}