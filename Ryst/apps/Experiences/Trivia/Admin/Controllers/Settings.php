<?php 
namespace Trivia\Admin\Controllers;

class Settings extends \Admin\Controllers\BaseAuth 
{
	use \Dsc\Traits\Controllers\Settings;
	
	protected $layout_link = 'Trivia/Admin/Views::settings/default.php';
	protected $settings_route = '/admin/trivia/settings';
    
    protected function getModel()
    {
        $model = new \Trivia\Models\Settings;
        return $model;
    }

}