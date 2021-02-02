<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/list/{type}", 
     * name="list")
     */
    public function general($type): Response
    {
        $croppedType = substr($type, 0, 2);

        $contacts = $this->getDoctrine()
        ->getRepository(Contact::class)
        ->findBy(['type' => $croppedType]);

        return $this->render('Contact/list.html.twig', [
            'type' => $type,
            'list' => $contacts
        ]);
    }

    /**
     * @Route("/new", 
     * name="new")
     */
    public function newContact(): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        
        return $this->render('Contact/new.html.twig', ['form' => $form->createView()]);
    }
    
}
