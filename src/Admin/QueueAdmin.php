<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class QueueAdmin extends AbstractAdmin
{
    public function configure()
    {
        parent::configure();
        $this->classnameLabel = 'Kolejka';
        $this->setLabel('Kolejka');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            //->add('id')
            ->add('season', null, [
                'label' => 'Sezon'
            ])
            ->add('number', null, [
                'label' => 'Kolejka',
            ])
            ->add('timeStart', null, [
                'label' => 'Data i godzina rozpoczęcia kolejki'
            ])
            ->add('timeEnd', null, [
                'label' => 'Data i godzina zakończenia kolejki'
            ])
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            //->add('id')
            ->add('season', null, [
                'label' => 'Sezon'
            ])
            ->add('number', null, [
                'label' => 'Kolejka'
            ])
            ->add('timeStart', null, [
                'label' => 'Data i godzina rozpoczęcia kolejki'
            ])
            ->add('timeEnd', null, [
                'label' => 'Data i godzina zakończenia kolejki'
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            //->add('id')
            ->add('season', null, [
                'label' => 'Sezon'
            ])
            ->add('number', IntegerType::class, [
                'label' => 'Kolejka',
                'attr' => [
                    'min' => 1,
                    'max' => 30
                ]
            ])
            ->add('timeStart', null, [
                'label' => 'Data i godzina rozpoczęcia kolejki',
            ])
            ->add('timeEnd', null, [
                'label' => 'Data i godzina zakończenia kolejki'
            ])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            //->add('id')
            ->add('season', null, [
                'label' => 'Sezon'
            ])
            ->add('number', null, [
                'label' => 'Kolejka'
            ])
            ->add('timeStart', null, [
                'label' => 'Data i godzina rozpoczęcia kolejki',
            ])
            ->add('timeEnd', null, [
                'label' => 'Data i godzina zakończenia kolejki'
            ])
            ;
    }
}
