<?php
/**
 * @package    Article Custom Field
 * @copyright  Copyright (c) 2016 web-tiki
 * @license    GNU General Public License version 3, or later
 */

// Protect from unauthorized access
defined ('_JEXEC') or die ('Restricted access');

class plgContentAcf extends JPlugin 
{
	protected $autoloadLanguage = true;

	function onContentPrepareForm($form, $data)
	{
		$app = JFactory::getApplication();

		if ($app->isAdmin())
		{
			$option = $app->input->get('option');
			$view   = $app->input->get('view');

			if ($option === 'com_content' && $view === 'article')
			{
				$model = JModelLegacy::getInstance('Article', 'ContentModel');
				$catid = $model->getItem($app->input->get('id'))->catid;

				if ($this->params->get('category') === $catid)
				{
					JForm::addFormPath(__DIR__ . '/forms');
					$form->loadFile('content', false);
				}
			}

			return true;
		}
	}
}