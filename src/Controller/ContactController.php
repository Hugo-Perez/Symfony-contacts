<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/list/{type}", 
     * name="list")
     */
    public function general($type): Response
    {
        return $this->render('contact/list.html.twig', ['type' => $type]);
    }
}
