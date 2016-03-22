# Joomla article custom fields
Joomla plugin to add a custom field to a selected category.
This plugin was created after [this question](http://joomla.stackexchange.com/questions/15764/article-custom-fields-for-one-category/15766?noredirect=1#comment19963_15766) on joomla.stackexchange.com.

##Instalation
1. [download ZIP](https://github.com/web-tiki/joomla-article-custom-field/archive/master.zip)
2. go to your admin panel and navigate to Extensions -> Manage and "Upload Package File" tab.
3. choose the downloaded .zip file and click "Upload & Install"
4. navigate to the plugin manager Extensions -> Plugins and search for "Content - ACF Article Custom Field"
5. enable the plugin and select the joomla category you need apply the custom field to
6. create a new article and select the category
7. under the "Custom field" tab, there is a custom text field

At this point, you are able to save the custom field value in the article params.

##Display the custom field value

Create a template override for the article. In `defaul.php` add the following code where you want the custom field to be displayed:


    <?php if ($this->item->params->get('custom_field1')) : ?>
	    <div class="custom_field1">
		    <?php echo $this->item->params->get('custom_field1'); ?>
	    </div>
    <?php endif; ?>


## Adding custom fields to the plugin

To add custom fields, you need to edit the `forms/content.xml` file. You can use joomla standard form field types (see [here](https://docs.joomla.org/Standard_form_field_types)).

Here are a few examples :

###Add a custom image field:

    <field
      name="custom_field_image"
      type="media"
      label="Custom image"
      description="Select a custom image"
      />

More info on the Media form field type [here](https://docs.joomla.org/Media_form_field_type).        

###Add a custom pdf document:

    <field
      type="filelist"
      name="custom_pdf_path"
      label="Custom PDF file"
      directory="images/documents"
      filter="\.pdf$"
      hide_default="true"
      />

This will output a select element and allow the selection of pdf files in the `images/documents` directory. The field will store the pdf name with extension. More info on the filelist form field type [here](https://docs.joomla.org/Filelist_form_field_type)
