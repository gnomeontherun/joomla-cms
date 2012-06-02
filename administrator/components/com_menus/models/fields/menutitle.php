<?php

JFormHelper::loadFieldClass('text');
require_once(JPATH_COMPONENT_ADMINISTRATOR.'/helpers/language.php');

class JFormFieldMenutitle extends JFormFieldText
{
	public function getInput() {
		// Return normal if frontend item
		if ($this->form->getField('client_id', 0) != 1) return parent::getInput();
		
		$html = '<input type="hidden" name="'.$this->name.'" value="'.$this->value.'" />';
		
		$language = JFactory::getLanguage();
		$languages = $language->getKnownLanguages(JPATH_ADMINISTRATOR);
		foreach ($languages as $i => $lang)
		{
			$tag = $lang['tag'];
			$languages[$i]['current'] = false;
			// Load the language for current language menu in case it hasn't been yet
			if ($language->getTag() == $tag)
			{
				$language->load('menu', JPATH_ADMINISTRATOR, $tag, true);
				$languages[$i]['current'] = true;
			}
			// Locate strings from active language files
			$file = MenusLanguageHelper::parseFile(JPATH_ADMINISTRATOR.'/language/'.$tag.'/'.$tag.'.menu.ini');
			$languages[$i]['title'] = $file[$this->value];
		}
		
		// Store in user session
		$app = JFactory::getApplication();
		$app->setUserState('com_menus.edit.item.titles.languages', $languages);
		
		// Initialize some field attributes.
		$size = $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$class = $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';

		$html .= '<input type="text" name="titles['.$language->getTag().']" value="'.JText::_($this->value).'" ' . $class . $size. ' />';
		$html .= '<span>'.$language->getName().'</span>';
		return $html;
	}
}