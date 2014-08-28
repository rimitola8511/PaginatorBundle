<?php

namespace Jmardz\PaginatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PaginatorBundle:Default:index.html.twig', array('name' => $name));
    }
}
