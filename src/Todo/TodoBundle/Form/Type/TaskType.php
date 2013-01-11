<?php

namespace Todo\TodoBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends BaseAbstractType
{
    protected $options = array(
        'data_class' => 'Todo\TodoBundle\Model\Task',
        'name'       => 'task',
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description');
        $builder->add('priority', 'model', array(
            'class' => 'Todo\TodoBundle\Model\Priority'));
        
        
        $builder->add('status', 'model', array(
            'class' => 'Todo\TodoBundle\Model\Status'));
        
        $builder->add('reporter', 'model', array(
            'class' => 'Todo\TodoBundle\Model\User'));
        $builder->add('assignee', 'model', array(
            'class' => 'Todo\TodoBundle\Model\User'));
        $builder->add('createdAt','date');
        $builder->add('updatedAt','date');
        
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Todo\TodoBundle\Model\Task',
        ));
    }
}
