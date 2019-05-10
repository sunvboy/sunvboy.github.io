/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.extraPlugins = 'dialogadvtab';
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	// Kcfinder
	config.filebrowserBrowseUrl = BASE_URL+'plugins/kcfinder-master/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = BASE_URL+'plugins/kcfinder-master/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = BASE_URL+'plugins/kcfinder-master/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl = BASE_URL+'plugins/kcfinder-master/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl = BASE_URL+'plugins/kcfinder-master/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = BASE_URL+'plugins/kcfinder-master/upload.php?opener=ckeditor&type=flash';

};
