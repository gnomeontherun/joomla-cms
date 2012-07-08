<?php

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

class JFormFieldExtensions extends JFormFieldList
{

	public $type = 'Extensions';

	protected function getOptions()
	{
		// Initialise variables.
		$options = array();
		$published = $this->element['published']? $this->element['published'] : array(0,1);
		$name = (string) $this->element['name'];

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('a.element AS value, a.name AS text');
		$query->from('#__extensions AS a');
		$query->where('a.type = '.$db->quote('component'));
		$query->where('a.client_id = 1');
		$query->where('a.enabled = 1');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// TODO run check on access for each option before listing
		for ($i = 0; $i < count($options); $i++)
		{
			$options[$i]->text = JText::_($options[$i]->text);
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
