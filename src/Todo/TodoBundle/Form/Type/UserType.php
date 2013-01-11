<?php

namespace Todo\TodoBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends BaseAbstractType
{
    protected $options = array(
        'data_class' => 'Todo\TodoBundle\Model\User',
        'name'       => 'user',
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }
}
