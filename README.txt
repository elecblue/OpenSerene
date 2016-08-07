## Serene Content Managment System -- README ##

# Read these instructions BEFORE installing SereneCMS!

## Installation ##
1. Unzip files to folder of choice on your computer.
2. With a text editor, edit "engine/config.inc.php" with the correct SQL information. Make sure the file is saved with the .php extention.
3. Once edited file(s) are saved, upload sCMS to your web directory of choice.
4. Run "install.php". If the information in config.inc.php is correct, it will display a success message. However, if the information provided is incorrect or inexistant, it will display a SQL error. 
5. If the installation is successful, delete install.php from your web server for this may cause all information to be deleted! Afterwords, enjoy sCMS!
- Extra Directions - 
- 6. To allow the ability to edit themes, CHMOD the directory and containing files of the theme you wish to edit.

## Note for versions 0.9.3 or !LOWER! ##
To disable the WYSIWYG editor, you must comment the javascript in admin/skin/aheader.php! Higher versions need not do this, as the settings
are editable in the admin panel.

## License Information ## 
SereneCMS is under a proprietary, free for not-for-profit use license developed by Atriotic, LLC. For more information, please email licence@atriotic.com.

## Information on first and third party modifications and augmentations ##
First and third party additions to SereneCMS _ARE NOT_ covered under our license and should be distributed with its own license.

## If you need support or have a question, please email support@atriotic.com ##