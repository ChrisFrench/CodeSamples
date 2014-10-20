<?php 
namespace Dash\Admin;

class Listener extends \Prefab 
{   

    public function onDisplayAdminUserEdit( $event )
    {   
        
        $item = $event->getArgument('item');

        $tabs = $event->getArgument('tabs');

        $tabs[] = 'Company';
        $event->setArgument('tabs',$tabs );
        $content = $event->getArgument('content');
        $content[] = $this->getCompanies($item);    
        $event->setArgument('content',$content );    		
      
        return $event;
    }


    protected function getCompanies($item) {
        $model = new \Dash\Models\Customers;
        $list = $model->getList();

        return $this->formatCompanies($item,$list);    
    }

    protected function formatCompanies($item, $list) {

        $html = '<select name="company">';

        foreach ($list as $company) {
            $selected =  ' ';
            if($company->_id == @$item->company) {
               $selected =  ' selected="selected" ';
            }

           $html .= '<option value="'.$company->_id.'"'. $selected .'>'.$company->name.'</option>';
        }
        $html .= '</select>';

        return $html;


    }

}