<?php

namespace App\Form;

use App\Entity\Emprunteur;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmprunteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('actif')
            ->add('user', EntityType::class, [
                    // type d'entité que le champ  permet de choisir
                    'class' => User::class,

                    // choix de du texte qui sera affiché dans le champ pour représenter un élément 
                    'choice_label' => function (User $object) {
                        // affichage de l'email et de l'id
                        return "{$object->getEmail()} ({$object->getId()})";
                    },

                    // champ à choix multiple ou choix unique
                    'multiple' => false,

                    // rendu visuel : select ou case à cocher / boutons radio
                    'expanded' => false,

                    // tri des données du champ par ordre alphabétique
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->orderBy('u.email', 'ASC');
                    },

                    // attributs HTML
                    'attr' => [
                        // ajout d'une classe css pour styler le champ
                        'class' => 'checkboxes-with-scroll',
                        // désactivation du champ pour éviter que le profile ne soit rattaché à un autre utilisateur
                        'disabled' => true,
                    ],
                ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunteur::class,
        ]);
    }
}
