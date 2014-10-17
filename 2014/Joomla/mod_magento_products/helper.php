<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_magento_prodcuts
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_magento_prodcuts
 *
 * @package     Joomla.Site
 * @subpackage  mod_magento_prodcuts
 * @since       1.5
 */
class MagentoProductsHelper
{
	var $_list;

	// gets the products directly from the module params
	//
	function getProductsFromParams($params) {
	
		$base = $params->get('api_url');
		$limit = $params->get('limit');	
		$attribute_filter = $params->get('attribute_filter');
		$filter_type = $params->get('filter_type');
		$value = urlencode(trim($params->get('value')));
		switch ($filter_type) {
			case 'like':
			case 'nlike':
				$value = '%'.$value.'%';
				break;
			
			default:
				# code...
				break;
		}
		$list = $this->doCall($base,$limit,$attribute_filter,$filter_type,$value ) ;
		
		return $list;
		
	}
	//gets the products from the Articles Params

	function getProductsFromArticleOverride($params, $id, $override) {

			$base = $override->magento_api_url;
			$limit = $override->magento_limit;	
			$attribute_filter = $override->magento_attribute_filter;
			$filter_type = $override->magento_filter_type;
			$value = urlencode(trim($override->magento_value));

			$list = $this->doCall($base,$limit,$attribute_filter,$filter_type,$value ) ;

			if(count($list)) {
					return $list;	
			} else {	
					$this->getProductsFromParams($params);	
			}


	}

	//gets the products From an article keyword first, and than from the module params second
	function getProductsFromArticle($params, $id) {
	
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		// select the meta keywords from the item
			$query->select('metadata')->from('#__content')->where('id = ' . (int) $id);
			$db->setQuery($query);
			$override = json_decode($db->loadResult());
			
			if($json->magento_override == 1) {
				return $this->getProductsFromArticleOverride($params, $id, $override);
			} 

			$query = $db->getQuery(true);
			$query->select('metakey')->from('#__content')->where('id = ' . (int) $id);
			$db->setQuery($query);


			if ($metakey = trim($db->loadResult()))
			{
				// explode the meta keys on a comma
				$keys = explode(',', $metakey);
				$likes = array();
				// assemble any non-blank word(s)
				foreach ($keys as $key)
				{
					$key = trim($key);
					if ($key)
					{
						$likes[] = $db->escape($key);
					}
				}

				if (count($likes))
				{


				$base = $params->get('api_url');
				$limit = $params->get('limit');	
				$attribute_filter = $params->get('attribute_filter');
				$filter_type = $params->get('filter_type');

				
				$value = $likes[0];

						switch ($filter_type) {
							case 'like':
							case 'nlike':
								$value = '%'.$value.'%';
								break;
							
							default:
								# code...
								break;
							}
						// http://magentohost/api/rest/products?filter[1][attribute]=entity_id&filter[1][nin]=3
				
						$list = $this->doCall($base,$limit,$attribute_filter,$filter_type,$value ) ;


								if(count($list)) {
									return $list;	
								} else {
									$this->getProductsFromParams($params);
								}
				

				} else {
					$this->getProductsFromParams($params);
				}

			}
		
	}

	function getProducts($params) {
	
		$app = JFactory::getApplication();
		
		$option = $app->input->get('option');
		$view = $app->input->get('view');

		$temp = $app->input->getString('id');
		$temp = explode(':', $temp);
		$id = $temp[0];
		if ($option == 'com_content' && $view == 'article' && $id)
		{ 
			return $this->getProductsFromArticle($params, $id);
		} else {
			return $this->getProductsFromParams($params);

		}

	}


	function doCall($base,$limit,$attribute_filter,$filter_type,$value ) {

		// http://magentohost/api/rest/products?filter[1][attribute]=entity_id&filter[1][nin]=3

		$url = $base . '?limit=' . $limit . '&filter[1][attribute]='.$attribute_filter.'&filter[1]'.'['.$filter_type.']='.$value;

						$ch = curl_init($url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$json = curl_exec($ch);
			
						if($json === FALSE) {
							echo curl_getinfo($ch) . '<br/>';
							echo curl_errno($ch) . '<br/>';
							echo curl_error($ch) . '<br/>';
							die();
						}

						$list = json_decode($json);

						return 	$list;
	}



	 function getList($params) {

	 	$app = JFactory::getApplication();
		
		$option = $app->input->get('option');
		$view = $app->input->get('view');

		$temp = $app->input->getString('id');
		$temp = explode(':', $temp);
		$id = $temp[0];

		if (empty( $this->_list ))
		{
		    $cache_key = base64_encode(serialize($params)) . '.list';
		    
		    if ($option == 'com_content' && $view == 'article' && $id) { $cache_key = $cache_key.$id; } 

		    $classname = strtolower( get_class($this) );
		    $cache = JFactory::getCache( $classname . '.list', '' );
		    $cache->setCaching(true);
		    $cache->setLifeTime(89000);
		    $list = $cache->get($cache_key);

			if(!version_compare(JVERSION,'1.6.0','ge'))
			{
				$list = unserialize( trim( $list ) );
			}

		    if (!$list)
		    {
		    	if ($option == 'com_content' && $view == 'article' && $id)
				{ 
					$list =  $this->getProductsFromArticle($params, $id);
				} else {
					$list = $this->getProductsFromParams($params);

				}
		        if ( empty( $list ) )
		        {
		            $list = array( );
		        }
		    
		       
		        $cache->store($list, $cache_key);
		    }
		     
		    $this->_list = $list;

		}
		return $this->_list;	
		
	}


}