Joomla Plugin Example
=====================

This is an example plugin files for [Joomla!](http://joomla.org/) CMS.

Creator: [Shivam Singh](https://shivamsinghportfolio.netlify.app/)

This repository is maintained for my submission in GSOC'22
-----

# myInject Plugin
When a user activates the plugin, it should inject a JS script into the webpage, which attaches the text from the parameter field to each headline.

## Live Video Demo
https://youtu.be/W-CsnaP4-S0


https://user-images.githubusercontent.com/82861332/163722280-3d4a7d02-9634-4dd2-ba1c-00e11feb39f1.MP4


## Configuration

### Initial setup the plugin

1. Download or clone this package.[Download the latest version of the plugin](https://github.com/shivamsingh124/joomla_plugin/)
2. Rename all `example` string to your plugin name.
3. Rename all `folder` string to your plugin group name.
4. Move whole folder to Joomla! dir: `/plugins/(your group)/(your plugin)`
5. Go to Joomla! Administrator -> Extension -> Discover and press `Discover` button.
6. Choose your plugin and install it.


Now the inital setup is completed.


## Feature

When a user activates the plugin, it should inject a JS script into the webpage, which attaches the text from the parameter field to each headline.


## Function Used


```PHP
class PlgSystemmyHeadingChange extends JPlugin
{
public function onBeforeCompileHead()
	{
   }
 }
```

## Plugin Specifications:
- Type: <b> System </b> <br/>
- Events Used: <b> onBeforeCompileHead </b>
- Installable through the <b> Joomla Extension Manager</b>.
- Executed in the <b> backend</b>.
- Follows <b> Joomla Coding Standards</b>.
- Follows Joomla <b> Naming Conventions</b> .
- <b> Joomla CodeSniffer </b> configured.

## Plugin Folder Structure

    ├── administrator
    │	└──language
    │   	└── en-GB.plg_system_HeadingChange.ini
    └── HeadingChange.php
    └── HeadingChange.xml
    └── joomla_plugin.rar
    └── Index.html


### Update Server

Please note that my update server only supports the latest version running the latest version of Joomla and atleast PHP 7.0.
Any other plugin version I may have added to the download section don't get updates using the update server.

## Issues / Pull Requests

You have found an Issue, have a question or you would like to suggest changes regarding this extension?
[Open an issue in this repo](https://github.com/shivamsingh124/joomla_plugin/issues/new) or submit a pull request with the proposed changes.

## Translations

You want to translate this extension to your own language? Check out the [Crowdin Page for my Extensions](https://joomla.crowdin.com) for more details. Feel free to [open an issue here](https://github.com/shivamsingh124/joomla_plugin/issues/new) on any question that comes up.

## License

[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)
[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)

# Hi, I'm Shivam, You can connect with me regarding any quries here :)! 👋

## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://shivamsinghportfolio.netlify.app/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/shivamsingh12/)
[![twitter](https://img.shields.io/badge/twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white)](https://twitter.com/)
