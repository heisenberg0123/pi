<?php
namespace App\service;



use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService{
    public function __construct(private MailerInterface $mailer)
    {

    }
    public function sendEmail($content='<p>See Twig integration for better HTML integration!</p>'): void
    {
        $email = (new Email())
            ->from('domamain01@gmail.com')
            ->to('koukikarim507@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            //->text('Sending emails is fun again!')
            ->html($content);

        $this->mailer->send($email);

        // ...
    }

}
