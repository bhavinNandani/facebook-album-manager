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
  - Remove zip button is also in the UI because if the user update his / her albums and want a current albums zip than , remove the zip and again create a new zip | feature gives the latest album to user and also maintain the load of the server |



### Tech

Some of the technology which are used to develop the facebook-album manager:

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
]); 
```

* Enable the Google Drive Api and get your Drive client id , drive client secret ans also add a redirect url
*  Enter your Google Credentials in `googleDrive/easyGoogle.php` 
 
```
$googledrive = new easy_googledrive(array(
	'ClientId'=>'{google drive client id}',
	'ClientSecret'=>'{google drive client secret}',
	'AccessType' => 'offline',
	'RedirectUri' => '{Application redirected URL }'
));

```  







### Installation
* Clone the repository and use [Composer](https://getcomposer.org/) to install dependencies of Facebook and Google Drive SDK.
* To install the php library. Go to library folder and run the below command
```
$ # To install the Facebook Graph API
$ composer requires facebook/graph-sdk
 
$ # To install Google Client API
$ composer require google/apiclient
```


### Plugins

Dillinger is currently extended with the following plugins. Instructions on how to use them in your own application are linked below.

| Plugin | README |
| ------ | ------ |
| Facebook | [facebook/php-graph-sdk](https://github.com/facebook/php-graph-sdk) |
| Google Drive | [google/google-api-php-client](https://github.com/tidyverse/googledrive/blob/master/)
| Bootstrap | [Bootstrap](https://getbootstrap.com/) |



License
----

MIT

