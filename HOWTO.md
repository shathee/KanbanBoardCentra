


# How To make this application work in local environment

## Requirements

 - PHP: 7.2+
 - Composer 
 - Github Account
 - Github Client ID and Client Secret [ Please visit this page ](https://docs.github.com/en/developers/apps/creating-an-oauth-app) to know how to get them. Please note that you have to create a new app if you do not have one. 
  
## Steps to setup

 1. Run `composer install`  in the root directory 
 2. Create a  `.env` file in the root directory
 3. Add the following parameters (Mandatory requirements)
	* `GH_CLIENT_ID`(Your Github Client ID)
	* `GH_CLIENT_SECRET` (Your Github Client Secret)
	* `GH_ACCOUNT`(Your Github Username)
	* `GH_REPOSITORIES`(List of Repository names separated by `|` )
 4. Additionally you can also add following additional `.env`  parameters
	* `PAUSE_LABELS`  (Takes issue labels separated by  `|`  to indicate an issue as paused )
	* `RESTRICTED`  (default value is `Yes` enables the mandatory authentication for the visitors to access the Board, Can be set to `No` if no authentication is required )
 5. If you are using built in server with PHP then run `php -S localhost:8000 -t src/public/` in the root folder 
 	and go to [http://localhost:8000](http://localhost:8000) in your browser
 6. If you  are using Local Development Environment (Laragon/Xampp) you will need some additional steps
	* create virtual host 
		 * For XAMPP you have to update `C:\xampp\apache\conf\httpd.conf`
		 * Laragon automatically creates Virtual Host for you) 
	* create `.htaccess ` file in the root folder and add the following (change the respective section with your one local domain/virtual host)
	 ```RewriteEngine on 
	 # Change example.test to be your primary domain.
	 RewriteCond %{HTTP_HOST} ^(www.)?example.test$
	 RewriteCond %{REQUEST_URI} !^/src/public
	 # Don't change this line.
	 RewriteCond %{REQUEST_FILENAME} !-f 
	 RewriteCond %{REQUEST_FILENAME} !-d
	 RewriteRule ^(.*)$ /src/public/$1
	 # Change example.test to be your primary domain again. 
	 # primary domain followed by / then the main file for your site, index.php etc.
	 RewriteCond %{HTTP_HOST} ^(www.)?example.test$
	 RewriteRule ^(/)?$ src/public/index.php [L]  ```
 7. Finally you have to update your github Developer app's `Homepage URL` abd `Authorization callback URL` with your local domain (`localhost:8000` or `example.test` or whatever virtual host name you use ) 
  
## Running the Tests
To run the test use `./vendor/bin/phpunit tests` command from root folder.  