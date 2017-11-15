<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SignOutController extends Controller
{
    /**
     * @Route("/signout", name="signout")
     */
    public function indexAction()
    {
    	try {
    		if ($this->get("session")->start() && $this->get("session")->get("id")) 
    		{
    			$this->get("session")->invalidate();
    			throw new \RuntimeException;
    		}
    		
    	} catch (\RunTimeException $e) {
			return $this->redirectToRoute("main");
		} catch (\Throwable $e) {
			$form->addError(("Vous êtes déjà déconnecté"));
		}	
    	
        return $this->render('FollowMeBundle:SignOut:index.html.twig', array(
           
        ));
    }
}
