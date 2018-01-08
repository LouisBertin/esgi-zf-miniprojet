<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\IndexController;
use Application\Controller\IndexControllerFactory;
use Application\Controller\MeetupController;
use Application\Controller\MeetupControllerFactory;
use Application\Form\ContactForm;
use Application\Helper\MeetupImg;
use Application\Helper\MeetupImgFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Application\Form\MeetupForm;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'meetup' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetup',
                    'defaults' => [
                        'controller' => MeetupController::class,
                        'action'     => 'show',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'action' => 'add',
                            ),
                        ),
                    ),
                    'view' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route' => '/view/:id',
                            'defaults' => array(
                                'action' => 'view',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route' => '/edit/:id',
                            'defaults' => array(
                                'action' => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'action' => 'delete',
                            ),
                        ),
                    ),
                ),
            ],
            'contact' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/contact',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'contact',
                    ],
                ],
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class,
            MeetupController::class => MeetupControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/index/contact' => __DIR__ . '/../view/application/index/contact.phtml',
            'application/meetup/show' => __DIR__ . '/../view/application/meetup/show.phtml',
            'application/meetup/view' => __DIR__ . '/../view/application/meetup/view.phtml',
            'application/meetup/edit' => __DIR__ . '/../view/application/meetup/edit.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupForm::class => InvokableFactory::class,
            ContactForm::class => InvokableFactory::class
        ],
    ],
    'upload_path' => 'public/img/meetup/',
    'view_helpers' => [
        'factories' => [
            MeetupImg::class => MeetupImgFactory::class
        ],
        'aliases' => [
            'meetupImg' => MeetupImg::class
        ]
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'application_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Entity/',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `application_driver` for any entity under namespace `Application\Entity`
                    'Application\Entity' => 'application_driver',
                ],
            ],
        ],
    ],
];
