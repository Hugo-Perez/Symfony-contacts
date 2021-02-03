<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/list/{type}", 
     * name="list")
     */
    public function list($type): Response
    {
        if ($type == "general") {
            $contacts = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->findAll();
        } else {
            $croppedType = substr($type, 0, 3);
    
            $contacts = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->findBy(['type' => $croppedType]);
        }

        return $this->render('Contact/list.html.twig', [
            'type' => $type,
            'list' => $contacts
        ]);
    }

    /**
     * @Route("/new", 
     * name="new")
     */
    public function newContact(Request $request): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('creation_success');
        }
        
        return $this->render('Contact/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/view/{id}", 
     * name="view")
     */
    public function viewContact($id): Response
    {
        $contact = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->find($id);
        $jsonContact = json_encode($contact);
        return new Response($jsonContact);
    }

    /**
     * @Route("/edit/{id}", 
     * name="edit")
     */
    public function editContact(): Response
    {
        return $this->render('Contact/success.html.twig');
    }

    /**
     * @Route("/delete/{id}", 
     * name="delete")
     */
    public function deleteContact(): Response
    {
        return $this->render('Contact/success.html.twig');
    }


     /**
     * @Route("/success", 
     * name="creation_success")
     */
    public function creationSuccess(): Response
    {        
        return $this->render('Contact/success.html.twig');
    }
    
}
