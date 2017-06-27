# OpenSerene

### Update (27 June 2017)
* Until I'm ready to push the changes I made (which have temporarily broken the software), there are blatant security issues that would make using OpenSerene silly in any production context -- remember, most of the current codebase is 12 years old and first written when I was 15 years old. Please, feel free to push changes and fix those issues as you uncover them (that'd be lovely), though. [-- Nik]

OpenSerene is a *very* lightweight content management system that first came into this world in 2005 and has been gently tinkered with since. I'm bringing it out of suspended animation and throwing it up on Github because it has been missing out on all of the advancements PHP development has undergone over the years. By the great power of collabrative development we can adapt OpenSerene to modern conventions. 

## Installation

1. (Assuming you downloaded an archive) Unzip files to folder of choice on your computer.
2. With a text editor, edit "engine/config.inc.php" with the correct SQL information.
3. Once the edited file(s) are saved, upload the whole party to your server.
4. Use your browser to navigate to "install.php" on your server. If the information in "config.inc.php" is valid, you'll see a message indicating the install was successful; however, if the information provided is incorrect or non-existant, you'll see some PHP error messages related to SQL operations. 
5. After the successful installation, remove the "install.php" file from your server as it presents a security issue and could result in losing your data if someone were to run it again. Afterwords, enjoy the simplicity of OpenSerene.

### Post-Install  

* If you wish to edit themes from within the control panel, you'll need to modify the permissions of any theme files and folders you install to permit overwriting.

## License

Copyright 2015 VICEGIRLS

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

#### Third-Party Software

Any third-party software used within OpenSerene or extensions/themes are not necessarily covered
under the same license as OpenSerene itself and are distributed with their own license.
