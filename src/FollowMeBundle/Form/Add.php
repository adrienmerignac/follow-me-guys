<?php

namespace FollowMeBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class Add extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add("dating_title", TextType::class, [
                "label" => "add.title",
                // Regles de validation à suivre
                "constraints" => [
                new NotBlank([
                    "message" => "add.title.error"
                ])
            ],
            "attr" => [
                "class" => "form-control",
                "placeholder" => "add.title",
            ]
        ])
        
        ->add("dating_description", TextareaType::class, [
                "label" => "add.description",
                // Regles de validation à suivre
                "constraints" => [
                new NotBlank([
                    "message" => "add.description.error"
                ])
            ],
            "attr" => [
                "class" => "form-control",
                "placeholder" => "add.description",
            ]
        ])
        
        ->add("dating_start", DateTimeType::class, [
                "label" => "add.dating.start",
                'format' => 'yyyy-MM-dd HH:mm',
                // Regles de validation à suivre
                "constraints" => [
                new NotBlank([
                    "message" => "add.dating.start.error"
                ])
            ],          
        ])
        
        ->add("dating_end", TimeType::class, [
                "label" => "add.dating.end",
                
                // Regles de validation à suivre
                "constraints" => [
                new NotBlank([
                    "message" => "add.dating.end.error"
                ])
            ],
        ])
        
        ->add("dating_link_href", UrlType::class, [
                "label" => "add.dating.link",
            // Regles de validation à suivre
                "constraints" => [
                new NotBlank([
                    "message" => "add.dating.link.error"
                ])
            ],
            "attr" => [
                "class" => "form-control",
                "placeholder" => "add.dating.link",
            ]
        ])
        
        ->add("dating_link_title", UrlType::class, [
            "label" => "add.dating.link.title",
            // Regles de validation à suivre
                "constraints" => [
                new NotBlank([
                    "message" => "add.dating.link.title.error"
                ])
            ],
            "attr" => [
                "class" => "form-control",
                "placeholder" => "add.dating.link.title",
            ]
        ]);        
    } 
}