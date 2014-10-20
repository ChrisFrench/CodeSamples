<?php
namespace Experiences\Trivia;

class Listener extends \Prefab
{

    public function onSystemRebuildMenu($event)
    {
        if ($model = $event->getArgument('model'))
        {
            $root = $event->getArgument('root');
            $users = clone $model;
            
            $users->insert(array(
                'type' => 'admin.nav',
                'priority' => 50,
                'title' => 'Trivia',
                'icon' => 'fa fa-user',
                'is_root' => false,
                'tree' => $root,
                'base' => '/admin/trivia'
            ));
            
            $children = array(
                array(
                    'title' => 'List',
                    'route' => './admin/trivia',
                    'icon' => 'fa fa-user'
                ),
            	array(
            				'title' => 'Games',
            				'route' => './admin/trivia/games',
            				'icon' => 'fa fa-cogs'
            		),
            		array(
            				'title' => 'Questions',
            				'route' => './admin/trivia/questions',
            				'icon' => 'fa fa-cogs'
            		),
                array(
                    'title' => 'Settings',
                    'route' => './admin/trivia/settings',
                    'icon' => 'fa fa-cogs'
                )
            );
            $users->addChildren($children, $root);
            
            \Dsc\System::instance()->addMessage('Trivia added its admin menu items.');
        }
    }
}