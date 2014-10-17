<?php
// No direct access
defined('_JEXEC') or die ;

jimport('joomla.plugin.plugin');
jimport( 'joomla.form.form' );

class plgContentMagento extends JPlugin {

	function onContentPrepareForm($form, $data) {

		
		if (!($form instanceof JForm)) {
			$this -> _subject -> setError('JERROR_NOT_A_FORM');
			return false;
		}

				// Check we're manipulating an
		    if ( $form->getName() != "com_content.article" ) {
		        return true;
		    }
		
			// Add the fields to the form.
			JForm::addFormPath(dirname(__FILE__).'/forms');
			$form -> loadFile('content', true);
		
	}

	function onContentAfterDisplay($context, $article, $params, $limitstart) {
		$html = $this->_getLayout('default', $vars, null, 'content');
		echo '<h1>onContentAfterDisplay</h1>';
	}

}


?>