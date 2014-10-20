<?php
class ExampleThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Example';


    protected function runSite()
    {   

        $f3 = \Base::instance();
    
       
        // add the media assets to be minified        
        $files = array(
            'site/js/jquery/jquery.min.js',
            'site/js/jquery/jquery.widget.min.js',
            'site/js/jquery/jquery.mousewheel.js',
            'site/js/prettify/prettify.js',
            'site/js/load-metro.js',
            'site/js/docs.js'
        );
        
        foreach ($files as $file) 
        {
            \Minify\Factory::js($file);
        }
        
        $files = array(
            'site/css/metro-bootstrap.css',
            'site/css/metro-bootstrap-responsive.css',
            'site/css/docs.css',
            'site/js/prettify/prettify.css',
            'site/css/style.css'
        );

        foreach ($files as $file)
        {
            \Minify\Factory::css($file);
        }
        \Minify\Factory::registerPath($f3->get('PATH_ROOT') . "public/");
        \Minify\Factory::registerPath($f3->get('PATH_ROOT') . "public/site/");
        \Minify\Factory::registerPath($f3->get('PATH_ROOT') . "public/images/");       
        \Minify\Factory::registerPath($f3->get('PATH_ROOT') . "public/site/images/");       
        
   
    }

}
$app = new ExampleThemeBootstrap();

