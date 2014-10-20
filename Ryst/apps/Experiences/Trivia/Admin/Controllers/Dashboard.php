<?php 
namespace Experiences\Trivia\Admin\Controllers;

class Dashboard extends \Admin\Controllers\BaseAuth 
{
   
    public function index() 
    {
   	$this->app->reroute('/admin/trivia/games');
    }
}