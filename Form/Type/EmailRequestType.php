<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Domstor\TemplateBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Description of EmailRequestType
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class EmailRequestType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        'validation_groups' => array(
            'create','update'
        ),
    ));
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                    'constraints' => [
                        new NotBlank(['groups' => ['create', 'update']])
                    ]
            ])
            ->add('phone', TextType::class, [
                    'constraints' => [
                        new NotBlank(['groups' => ['create', 'update']])
            ]
            ])
            ->add('email', EmailType::class, [
                    'constraints' => [
                        new NotBlank(['groups' => ['create', 'update']]),
                        new Email(['groups' => ['create', 'update']]),
            ]
            ])
            ->add('message', TextareaType::class, [
                    'constraints' => [
                        new NotBlank(['groups' => ['create', 'update']])
            ]
            ])
            ->add('policy', CheckboxType::class, ['attr' => ['class' => 'form-check-input']])
            ->add('captcha', CaptchaType::class, ['reload'=>true, 'as_url'=>true, 'attr' => ['class' => 'form-control input']])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn']
            ])
        ;
    }
}
