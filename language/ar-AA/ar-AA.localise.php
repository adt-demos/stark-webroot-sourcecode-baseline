<?php
/**
 * @version		$Id: ar-AA.localise.php 100644 2013-03-27 16:15:23Z Abu Nidal $
 * @package    Joomla.Language
 * @Copyright  Copyright (C) Translation 2010 - 2013 Ashraf Damra/Abu Nidal www.jarabic.com. All rights reserved.
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
/**
 * ar-AA localise class
 *
 * @package		Joomla.Language
 * @since		1.6
 */
abstract class Ar_AALocalise 
{
	/**
	 * Returns the potential suffixes for a specific number of items
	 *
	 * @param	int $count  The number of items.
	 *
	 * @return	array  An array of potential suffixes.
	 *
	 * @since	1.6
	 */
	public static function getPluralSuffixes($count) 
	{
		if ($count == 0) 
		{
			$return = array('0');
		}
		elseif($count == 1) 
		{
			$return = array('1');
		}
		else 
		{
			$return = array('MORE');
		}
		return $return;
	}

	/**
	 * Returns the ignored search words
	 *
	 * @return	array  An array of ignored search words.
	 *
	 * @since	1.6
	 */
	public static function getIgnoredSearchWords() 
	{
		$search_ignore = array();
		$search_ignore[] = "�";
		$search_ignore[] = "��";
		$search_ignore[] = "���";
		$search_ignore[] = "��";
		$search_ignore[] = "��";
		$search_ignore[] = "��";
		$search_ignore[] = "���";
		$search_ignore[] = "��";
		$search_ignore[] = "���";
		$search_ignore[] = "���";
		return $search_ignore;
	}

	/**
	 * Returns the lower length limit of search words
	 *
	 * @return	integer  The lower length limit of search words.
	 *
	 * @since	1.6
	 */
	public static function getLowerLimitSearchWord() 
	{
		return 3;
	}

	/**
	 * Returns the upper length limit of search words
	 *
	 * @return	integer  The upper length limit of search words.
	 *
	 * @since	1.6
	 */
	public static function getUpperLimitSearchWord() 
	{
		return 75;
	}

	/**
	 * Returns the number of chars to display when searching
	 *
	 * @return	integer  The number of chars to display when searching.
	 *
	 * @since	1.6
	 */
	public static function getSearchDisplayedCharactersNumber() 
	{
		return 200;
	}
}

