<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Languages component helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_languages
 * @since		1.6
 */
class MenusLanguageHelper
{
	/**
	 * Method for parsing ini files
	 *
	 * @param		string	$filename Path and name of the ini file to parse
	 *
	 * @return	array		Array of strings found in the file, the array indices will be the keys. On failure an empty array will be returned
	 *
	 * @since		2.5
	 */
	public static function parseFile($filename)
	{
		jimport('joomla.filesystem.file');

		if (!JFile::exists($filename))
		{
			return array();
		}

		// Capture hidden PHP errors from the parsing
		$version			= phpversion();
		$php_errormsg	= null;
		$track_errors	= ini_get('track_errors');
		ini_set('track_errors', true);

		if ($version >= '5.3.1')
		{
			$contents = file_get_contents($filename);
			$contents = str_replace('_QQ_', '"\""', $contents);
			$strings 	= @parse_ini_string($contents);

			if ($strings === false)
			{
				return array();
			}
		}
		else
		{
			$strings = @parse_ini_file($filename);

			if ($strings === false)
			{
				return array();
			}

			if ($version == '5.3.0' && is_array($strings))
			{
				foreach ($strings as $key => $string)
				{
					$strings[$key] = str_replace('_QQ_', '"', $string);
				}
			}
		}

		return $strings;
	}

	/**
	 * Filter method for language keys.
	 * This method will be called by JForm while filtering the form data.
	 *
	 * @param		string	$value	The language key to filter
	 *
	 * @return	string	The filtered language key
	 *
	 * @since		2.5
	 */
	public static function filterKey($value)
	{
		$filter = JFilterInput::getInstance(null, null, 1, 1);

		return strtoupper($filter->clean($value, 'cmd'));
	}

	/**
	 * Filter method for language strings.
	 * This method will be called by JForm while filtering the form data.
	 *
	 * @param		string	$value	The language string to filter
	 *
	 * @return	string	The filtered language string
	 *
	 * @since		2.5
	 */
	public static function filterText($value)
	{
		$filter = JFilterInput::getInstance(null, null, 1, 1);

		return $filter->clean($value);
	}
}
