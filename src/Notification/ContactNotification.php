<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactNotification{

    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact){
        $email = (new TemplatedEmail())
            ->from('noreply@nantedevy.mg')
            ->to('contact@nantedevy.mg')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            ->replyTo($contact->getEmail())
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Agency: '.$contact->getProperty()->getTitle())
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact,
            ]);

        $this->mailer->send($email);
    }
}