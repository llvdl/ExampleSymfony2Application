<?php

namespace Finalist\LennaertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LennaertBundle:Default:index.html.twig', array('name' => $name));
    }
}
