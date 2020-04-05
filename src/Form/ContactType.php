<?php

namespace App\Form;

use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'ФИО *',
                'required'   => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Электронная почта',
                'required'   => false
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Телефон *'
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Сообщение *'
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Отправить'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
