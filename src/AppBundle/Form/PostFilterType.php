<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

/**
 * PostFilterType filtro.
 * @author Nombre Apellido <name@gmail.com>
 */
class PostFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('booleano', 'filter_choice', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('entero', 'filter_number_range', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('smallEntero', 'filter_number_range', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('bigEntero', 'filter_number_range', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('cadena', 'filter_text_like', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('texto', 'filter_text_like', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('fechatiempo', 'filter_date_range', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('dechatiempoz', 'filter_date_range', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('fecha', 'filter_date_range', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('tiempo', 'filter_text', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('numerodecimal', 'filter_number_range', array(
                'attr'=> array('class'=>'form-control')
            ))
            ->add('numeroconcoma', 'filter_number_range', array(
                'attr'=> array('class'=>'form-control')
            ))
        ;

        $listener = function(FormEvent $event)
        {
            // Is data empty?
            foreach ((array)$event->getForm()->getData() as $data) {
                if ( is_array($data)) {
                    foreach ($data as $subData) {
                        if (!empty($subData)) {
                            return;
                        }
                    }
                } else {
                    if (!empty($data)) {
                        return;
                    }    
                }
            }
            $event->getForm()->addError(new FormError('Filter empty'));
        };
        $builder->addEventListener(FormEvents::POST_SUBMIT, $listener);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_postfiltertype';
    }
}
