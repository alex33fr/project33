<?php

namespace App\Form;

use App\Entity\ContactForm;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
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
            ->add('phone', TelType::class, [
                'label' => 'Телефон *'
            ])
            ->add('captcha', CaptchaType::class,[
                'label' => 'Введите код с картинки* :',
                'distortion' => false

            ])
            ->add('message', TextareaType::class, [
                'label' => 'Сообщение *',
                'required'   => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}
