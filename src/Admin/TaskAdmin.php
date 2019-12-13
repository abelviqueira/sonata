<?php
/**
 * Created by PhpStorm.
 * User: Nacho
 * Date: 12/12/2019
 * Time: 16:56
 */

namespace App\Admin;

use App\Entity\Task;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Form\Type\ModelType;


final class TaskAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Task name', ['class' => 'col-md-9'])
                ->add('name', TextType::class)
            ->end()
            ->with('Assigned to', ['class' => 'col-md-3'])
                ->add('assigned', ModelType::class, [
                    'class' => User::class,
                    'property' => 'email'
                ])
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('id');
    }

    public function toString($object)
    {
        return $object instanceof Task
            ? $object->getName()
            : 'Task'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('assigned', null, [], EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])
        ;
    }

}