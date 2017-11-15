<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FollowMeBundle\Form\SignIn;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use FollowMeBundle\Entity\User;


class SignInController extends Controller
{
    /**
     * @Route("/signin", name="signin")
     */
    public function indexAction(Request $request)
    {    
		try 
		{    	
    			$this->get("session")->start();    	
			if ($this->get("session")->get("id")) 
			{
				throw new \RuntimeException;
			}    	
				$form = $this->createForm(SignIn::class);
				$form->handleRequest($request);   	
				// Select One du User							
			if (!$form->isSubmitted()
				|| !$form->isValid()) 
			{
    			throw new \InvalidArgumentException;
    		}
			if (($user = $this
			    ->getDoctrine()
			    ->getManager()
			    ->getRepository(User::class)
			    ->findOneBy(["userMail" => $form->getData()["user_mail"]]))
			    && password_verify($form->getData()["user_pswd"], $user->getUserPswd())) 
			{
				
    		      $this->get("session")->set("id", $user->getUserId());
    			  throw new \RuntimeException;
    		    }	
    		      throw new \Exception;
						
    	   } catch (\InvalidArgumentException $e) {
    	   } catch (\RunTimeException $e) {
    		return $this->redirectToRoute("main");
        	} catch (\Exception $e) {
    		$form->addError(new FormError("sign.up.error"));
    	   }
        return $this->render('FollowMeBundle:SignIn:index.html.twig',
          	[
				"form" => $form->createView()
			]
        );
    }
}


