<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Table;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class MatchAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('scoreHome')
            ->add('scoreAway')
            ->add('goalsHome')
            ->add('goalsAway')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('scoreHome')
            ->add('scoreAway')
            ->add('goalsHome')
            ->add('goalsAway')
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
            ->add('home',null, [
                'label' => 'Gospodarze'
            ])
            ->add('away',null, [
                'label' => 'Goście'
            ])
            ->add('scoreHome', null, [
                'label' => 'Gole gości'
            ])
            ->add('scoreAway', null, [
                'label' => 'Gole gospodarzy'
            ])
            ->add('goalsHome', null, [
                'label' => ''
            ])
            ->add('goalsAway', null, [
                'label' => ''
            ])
            ->add('queue', null, [
                'label' => ''
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('scoreHome')
            ->add('scoreAway')
            ->add('goalsHome')
            ->add('goalsAway')
            ;
    }
}
