<?php

namespace FooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BarController extends Controller
{
    /**
     * @Route("/bar")
     */
    public function indexAction()
    {
        return $this->render('FooBundle:Bar:index.html.twig', array(
            // ...
        ));
    }

}
