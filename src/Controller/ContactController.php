<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/list/{type}", 
     * name="general",
     * req={})
     */
    public function general():Response {
        $this->render('contact/list.html.twig', 
        [])
    }
}
