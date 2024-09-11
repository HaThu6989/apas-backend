<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'base_')]
class BaseController extends AbstractController
{
    public function __construct(private MailerInterface $mailer)
    {
        // ...
    }

    #[Route('', methods: ['GET'], name: 'index')]
    public function index(): Response
    {
        $email = (new Email())
            ->from('noreply@apas.asso.fr')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
        $this->mailer->send($email);
        return $this->json([]);
    }
}
