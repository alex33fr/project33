<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Название продукта *',
                'required' => true
            ])
            ->add('imageFile', VichImageType::class, [
                'allow_delete' => true,
                'download_uri' => true,
                'download_label' => 'Скачать',
                'label' => 'Картинка *',
                'required' => false
            ])
            ->add('altImage', TextType::class,[
                'label' => 'Alt SEO для картинки *',
                'required' => false
            ])
            ->add('model', TextType::class, [
                'label' => 'Модель',
                'required' => false
            ])
            ->add('color', TextType::class, [
                'label' => 'Цвет',
                'required' => false
            ])
            ->add('descOne', CKEditorType::class, [
                'label' => 'Краткое описание *',
                'required' => false
            ])
            ->add('descTwo', CKEditorType::class, [
                'label' => 'Полное описание',
                'required' => false
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Цена',
                'currency' => 'RUB',
                'required' => false
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Выбрать категорию которой пренадлежит товар *',
                'placeholder' => 'Выберите категорию',
                'required' => true,
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
            'data_class' => Product::class,
        ]);
    }
}
