<?php
return array(
    'router'      => array(
        'routes' => array(
            'gallery' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/gallery',
                    'defaults' => array(
                        'controller' => 'Gallery\Controller\Gallery',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'action' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/:id]',
                            'constraints' => array(
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'        => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Gallery\Controller\Gallery' => 'Gallery\Controller\GalleryController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'form_elements' => array(
        'invokables' => array(
            'Gallery' => 'Gallery\Form\GalleryForm',
        ),
    ),
    'doctrine'     => array(
        'driver' => array(
            'gallery_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Gallery/Entity')
            ),

            'orm_default'          => array(
                'drivers' => array(
                    'Gallery\Entity' => 'gallery_entities'
                )
            )
        )
    ),
);