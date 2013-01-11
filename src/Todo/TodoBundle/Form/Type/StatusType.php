<?php

namespace Todo\TodoBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StatusType extends BaseAbstractType
{
    protected $options = array(
        'data_class' => 'Todo\TodoBundle\Model\Status',
        'name'       => 'status',
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }
}
