<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use FollowMeBundle\Form\SignUp;
// use FollowMeBundle\Entity\User;

class SignUpController extends Controller
{
    /**
     * @Route("/signup", name="signup")
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
				$form = $this->createForm(SignUp::class);
				$form->handleRequest($request);
				// Création d'un User
			if ($form->isSubmitted() && $form->isValid()) 
			{
				if ($form->getData()["user_pswd"]
					!== $form->getData()["confirm"]) 
				{
					$form->get("confirm")
					->addError(new FormError("sign.confirm.unvalid.error"));
					throw new \InvalidArgumentException;
				}	
				$user = $this->get("follow_me.user");
				$user->setUserMail($form->getData()["user_mail"]);	
				$user->setUserPswd(password_hash($form->getData()["user_pswd"], PASSWORD_DEFAULT));
				$this->getDoctrine()->getManager()->persist($user);
				$this->getDoctrine()->getManager()->flush();
				// Création d'une session 
				$this->get("session")->set("id", $user->getUserId());
				throw new \RuntimeException;
			}
		} catch (\InvalidArgumentException $e) {	
		} catch (\RunTimeException $e) {
			return $this->redirectToRoute("main");
		} catch (\Throwable $e) {
			$form->addError(new FormError("sign.up.user.error"));
		}	
			return $this->render('FollowMeBundle:SignUp:index.html.twig', 
			[
				"form" => $form->createView()
			]
		);
    }
}
