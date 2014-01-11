<?php
/**
 * Nav.php contains the Nav class
 * @author Aaron Crowder <aaron@aaroncrowder.com>
 */

/**
 * Nav class
 * 
 * Build links and navigation elements
 */
class Nav
{
	/**
	 * BuildMainNav()
	 * 
	 * Builds the main navigation menu for Twitter Bootstrap
	 * 
	 * @param array $links
	 * @param array $URIdata
	 */
	public static function BuildMainNav($links, $curPage)
	{
		if(is_array($links)) {
			$strHTML = '';

			foreach ($links as $key => $value) {
				$strHTML .= '<li' . 
							(($value[0] == strtolower($curPage)) ? ' class="active"' : '') . 
							'><a href="' . 
							BASEURI . 
							$value[0] . 
							(($value[1] == 'index') ? '' : '/' . $value[1]) . 
							'">' . $key . '</a></li>';
			}

			return $strHTML;
		} else {
			throw new Exception("Function parameter must be an array!");
		}
	}

	public static function BuildTextLink($link, $options = array())
	{
		if(!empty($link) && is_array($link)) {
			$strHTML = '<a href="' . BASEURI . $link[1] . '"';

			if(!empty($options)) {
				foreach ($options as $key => $value) {
					$strHTML .= $key . '="' . $value . '" ';
				}
			}

			$strHTML .= '>' . $link[0] . '</a>';

			return $strHTML;
		} else {
			throw new Exception("Function parameter must be an array!");
		}
	}
}