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
    public function list(Request $request, $type): Response
    {
        // Devolvemos una lista de contactos filtrando por el tipo de los mismos
        // y guardamos el tipo escogido como variable de sesión.
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
        $session = $request->getSession();
        $session->set("lastType", $type);
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
        // Creamos un contacto vacío que recogerá los datos del formulario de
        // creación en caso de ser válidos. Después, lo persistimos.
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->render('Contact/success_create.html.twig');
        }
        
        return $this->render('Contact/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/view/{id}", 
     * name="view")
     */
    public function viewContact($id): Response
    {
        //Buscamos el contacto por el id y le devolvemos el formulario para ver los datos.
        $contact = $this->getDoctrine()
        ->getRepository(Contact::class)
        ->find($id);

        $form = $this->createForm(ContactType::class, $contact);
        $form->remove('create');

        return $this->render('Contact/view.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact
        ]);
    }

    /**
     * @Route("/edit/{id}", 
     * name="edit")
     */
    public function editContact(Request $request, $id): Response
    {
        // Creamos el formulario sin el boton de crear y 
        // persistimos los datos que nos manda el usuario desde el formulario.
        $contact = $this->getDoctrine()
        ->getRepository(Contact::class)
        ->find($id);

        $form = $this->createForm(ContactType::class, $contact);
        $form->remove('create');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $session = $request->getSession();
            return $this->render('Contact/success_edit.html.twig', [
                'lastType' => $session->get('lastType')
            ]);
        }

        return $this->render('Contact/edit.html.twig', [
           'form' => $form->createView(),
           'contact' => $contact
        ]);
    }

    /**
     * @Route("/delete/{id}", 
     * name="delete")
     */
    public function deleteContact(Request $request, $id): Response
    {
        // Buscamos el contacto por id, lo eliminamos y devolvemos la página de eliminacion correcta.
        $contact = $this->getDoctrine()
        ->getRepository(Contact::class)
        ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contact);
        $entityManager->flush();

        $session = $request->getSession();
        return $this->render('Contact/success_delete.html.twig', [
            'lastType' => $session->get('lastType')
        ]);
    }
    
}
