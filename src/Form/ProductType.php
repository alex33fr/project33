<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Название'])
            ->add('imageFile', VichImageType::class, [
                'allow_delete' => true,
                'download_link' => true,
                'download_uri' => true,
                'download_label' => 'Скачать',
                'label' => 'Картинка',
            ])
            ->add('model', TextType::class, ['label' => 'Модель'])
            ->add('color', TextType::class, ['label' => 'Цвет'])
            ->add('descOne', TextareaType::class, ['label' => 'Краткое описание'])
            ->add('descTwo', TextareaType::class, ['label' => 'Полное описание'])
            ->add('price', MoneyType::class, ['label' => 'Цена',
                'currency' => 'RUB'
            ])
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
