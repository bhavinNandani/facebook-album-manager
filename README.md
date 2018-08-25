#  Facebook album manager




Facebook album manager is a gogle drive-enabled, mobile-ready, offline-storage, PHP powered with light bootstrap design website
# Live Demo
[Click here](https://newfbbhavin.000webhostapp.com) for the demo, [Mail me](mailto:nandanibhavin@gmail.com) to check it out as a tester

# Features!

  - User can download whole album of facebook by the single click .zip formated!
  - User can download all album by the single click .zip formated!
  - Also user can backup albums into the google drive single or all
  - Drag and drop images (requires your Dropbox account be linked)
  - User can view the images contain in the album



### Tech

Some of the technology which are used to develop the facebook-album manager:
[:beginner:]
* [HTML5](html5.org) - HTML enhanced for web apps!
* [PHP](php.net/) - PHP uses for the scripting
* [Bootstrap](https://getbootstrap.com/) - Designing purpose* 


### Requirments
  * Create application in [Facebook developer mode](https://developers.facebook.com/apps/) , and add facebook login product to your application
 - Get the application id, applicain secreat 
- Replace app_id and app_secret in config.php with your facebook app_id and app_secret. Configure call back url as: callback.php in Facebook OAuth.
```php 
$FB = new \Facebook\Facebook([
 'app_id' => '{Your facebook id here}',
'app_secret' => '{Your facebook app secret}',
		'default_graph_version' => 'v3.1'
]); ```





### Installation
Clone the repository and use composer to install dependencies of Facebook and Google Drive SDK.

Follow the installation instructions if you do not already have composer installed. Run the install command from the root directory to setup the dependencies.
Facebook album manager requires [Node.js](https://nodejs.org/) v4+ to run.

Install the dependencies and devDependencies and start the server.
