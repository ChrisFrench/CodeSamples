<?php 
namespace Dash;

class Listener extends \Prefab 
{
   public function onSystemRebuildMenu( $event )
    {

      if ($model = $event->getArgument('model'))
        {  
            $root = $event->getArgument( 'root' );
            $modules = clone $model;
        
            $modules->insert(
                    array(
                            'type'  => 'admin.nav',
                            'priority' => 210,
                            'title' => 'Customers',
                            'icon'  => 'fa fa-building',
                            'is_root' => false,
                            'tree'  => $root,
                            'base' => '/admin/customers',
                    )
            );
            
            $children = array(
                    array( 'title'=>'List', 'route'=>'/admin/customers', 'icon'=>'fa fa-list' ),
                    array( 'title'=>'Add New', 'route'=>'/admin/customers/create', 'icon'=>'fa fa-plus' ),
            );
            $modules->addChildren( $children, $root );
            
            \Dsc\System::instance()->addMessage('Customers added its admin menu items.');
        }
        
    } 
}