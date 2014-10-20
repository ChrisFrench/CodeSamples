<?php 
namespace Experiences\Trivia\Models;

class Settings extends \Dsc\Mongo\Collections\Settings
{
    public $home = array(
        'include_categories_widget' => 1
    );
    
    protected $__type = 'trivia.settings';
}