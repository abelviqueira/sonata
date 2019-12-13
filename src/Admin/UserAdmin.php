<?php
/**
 * Created by PhpStorm.
 * User: Nacho
 * Date: 12/12/2019
 * Time: 16:56
 */

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

final class UserAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('email', EmailType::class);
        $formMapper->add('password', PasswordType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('email');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('email');
        $listMapper->add('roles');
        $listMapper->addIdentifier('task');
    }

    public function toString($object)
    {
        return $object instanceof User
            ? $object->getUsername()
            : 'User'; // shown in the breadcrumb on the create view
    }

}