<?php

namespace App\Controller;

use App\Form\ContactType;

use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function index(Request $request, Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $message = (new \Swift_Message('Новый запрос от клиента'))
                    ->setFrom($contact['email'])
                    ->setTo('a.privalov@hotmail.com')
                    ->setBody(
                        $this->renderView(
                            'email/contact.html.twig', compact('contact')
                        ),
                        'text/html'
                    );

                    $mailer->send($message);
                    $this->addFlash('success', 'Ваша заявка отправлена, мы обязательно вам ответим!');

                    return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $form->createView()
        ]);
    }
}
