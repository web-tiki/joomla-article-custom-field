<?php
/**
 * @package    Article Custom Field
 * @copyright  Copyright (c) 2016 web-tiki
 * @license    GNU General Public License version 3, or later
 */

// Protect from unauthorized access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class plgContentAcf extends JPlugin {
	protected $autoloadLanguage = true;

	function onContentPrepareForm($form, $data)
	{
		$app = JFactory::getApplication();
		$option = $app->input->get('option');
		switch($option) {
			case 'com_content':
			if ($app->isAdmin())
			{
				JForm::addFormPath(__DIR__ . '/forms');
				$form->loadFile('content', false);

				$model = JModelLegacy::getInstance('Article', 'ContentModel');
				$catid = $model->getItem($app->input->get('id'))->catid;

				$pluginCatId = $this->params->get('category');

				$document = JFactory::getDocument();
				$document->addScriptDeclaration('
				jQuery( document ).ready(function() {
					var selectedCategory = jQuery("#jform_catid").val(),
							catId = ' . $catid . ',
							pluginCat = ' . $pluginCatId . ',
							fields = jQuery("#attrib-acf .controls"),
							labels = jQuery("#attrib-acf .control-label"),
							warningMessage = jQuery("#attrib-acf .control-group .acf_warningMessage");


					jQuery("#jform_catid").change(function() {
						selectedCategory = jQuery("#jform_catid").val();
						if(selectedCategory != pluginCat){
							fields.hide();
							labels.hide();
							warningMessage.show();
						} else {
							fields.show();
							labels.show();
							warningMessage.hide();
						}
					});

					if(selectedCategory != pluginCat){
						fields.hide();
						labels.hide();
					} else {
						warningMessage.hide();
					}

				});
				');
			}
			return true;
		}
		return true;
	}
}
?>
