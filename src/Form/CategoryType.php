<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Название категории',
                'required' => true
            ])
            ->add('imageFile', VichImageType::class, [
                'allow_delete' => true,
                'download_link' => true,
                'download_uri' => true,
                'download_label' => 'Скачать',
                'label' => 'Картинка',
                'required' => true
            ])
            ->add('altImage', TextType::class,[
                'label' => 'Alt SEO для картинки',
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'required' => false
            ])
            ->add('parent', EntityType::class, [
                'class' => Category::class,
                'label' => 'Категория',
                'placeholder' => 'Выберите категорию',
                'choice_label' => function(Category $category){
                    return $category->getTitle();
                },
                'group_by' => function(Category $category) {
                    return $category->getParent();
                }
                ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
