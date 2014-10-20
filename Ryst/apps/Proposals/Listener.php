<?php 
namespace Proposals;

class Listener extends \Prefab 
{
    public function onSystemRebuildMenu( $event )
    {
		if ($model = $event->getArgument('model'))
		{
			$root = $event->getArgument( 'root' );
			$proposals = clone $model;
        		 
			$proposals->insert(
					array(
						'type'	=> 'admin.nav',
						'priority' => 50,
						'title'	=> 'Proposals',
						'icon'	=> 'fa fa-user',
        				'is_root' => false,
						'tree'	=> $root,
						'base' => '/admin/proposals',
					)
				);
        	
			$children = array(
        			array( 'title'=>'List', 'route'=>'/admin/proposals', 'icon'=>'fa fa-user' ),
              		
        	        array( 'title'=>'Settings', 'route'=>'/admin/proposals/settings', 'icon'=>'fa fa-cogs' ),
			);
       		$proposals->addChildren( $children, $root );
        	
        	\Dsc\System::instance()->addMessage('Proposals added its admin menu items.');
        }
        
    }
}