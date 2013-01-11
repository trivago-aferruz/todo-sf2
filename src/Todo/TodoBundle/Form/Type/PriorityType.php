<?php

namespace Todo\TodoBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PriorityType extends BaseAbstractType
{
    protected $options = array(
        'data_class' => 'Todo\TodoBundle\Model\Priority',
        'name'       => 'priority',
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }
}
