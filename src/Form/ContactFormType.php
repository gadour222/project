<?php
// src/Form/ContactFormType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Your Name',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Your Email',
                'required' => true,
            ])
            ->add('subject', TextType::class, [
                'label' => 'Subject',
                'required' => true,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here if needed
        ]);
    }
}
