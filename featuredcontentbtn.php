<?php
# @Author: SPEDI srl
# @Date:   30-01-2018
# @Email:  sviluppo@spedi.it
# @Last modified by:   SPEDI srl
# @Last modified time: 30-01-2018
# @License: GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
# @Copyright: Copyright (c) SPEDI srl

defined('_JEXEC') or die;

/**
 * Editor Featured Content Btn
 *
 * @since  1.5
 */
class PlgButtonFeaturedContentBtn extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Featured Content button
	 *
	 * @param string  $name  The name of the button to add
	 *
	 * @return array A two element array of (textToInsert)
	 */
	public function onDisplay($name)
	{
		$doc  = JFactory::getDocument();

		$link = '../plugins/editors-xtd/featuredcontentbtn/display.php?ih_name='.$name;

		JHTML::_('behavior.modal');
		$button          = new JObject;
		$button->modal   = true;
		$button->class   = 'btn';
		$button->text    = JText::_('Contenuto in evidenza');
		$button->name    = 'featured';
		$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";
		$button->link    = $link;

		return $button;
	}
}
