<?php

namespace FollowMeBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\AbstractType;

class SignIn extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
	$builder
	->add("user_mail", EmailType::class, [
			"label" => "sign.mail",
			// Regles de validation à suivre
			"constraints" => [
		 			new Email([
							"message" => "sign.up.error"
					]),
					new NotBlank([
							"message" => "sign.mail.error"
					])
			],
			"attr" => [
					"class" => "form-control",
					"placeholder" => "sign.mail",
			]
	])
	
	->add("user_pswd", TextType::class, [
			"label" => "sign.pswd",
			// Regles de validation à suivre
			"constraints" => [
					new Regex([
							"pattern" => "/^[\w]{8,32}$/",
							"message" => "sign.pswd.carac.error"
					]),
					new NotBlank([
							"message" => "sign.pswd.error"
					])
			],
			"attr" => [
					"class" => "form-control",
			]
		]);
	}
}