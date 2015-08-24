## WedPlan - a proof-of-concept proejct made with Laravel 5.1

## Overview
This app is a proof-of-concept of a SAAS product with Stripe API integrated for payments. The service is called WedPlan.

It provides some useful tools like email invites, RSVP system for people who are about to get married. The home page displays some slogan to guide the user to the product page, where you can choose to 'learn more' about or 'sign up' for the package. Once the package is chosen, it will take you to the register page if not logged in, where you are required to sign up as a user, then the system will redirect to the payment page, where the credit card info is taken. Once the payment is processed, it will direct to either the success or fail page depending on the transaction. Upon successful transaction, user will be upgraded to subscription user in the database with the plan start date and end date, and the transaction will also be stored in the database for records and reports.

NOTE: the actual email invites, RSVP systems, and other functions are not implemented yet, this is just a concept. 


## Installation
Due to the time constraint and hardware limitation, this app is developed on a Windows environment with Winginx. Homestead and Vagrant are not used. The database used is mongodb, mongolab is used for ease of use. (No need to migrate/seed database, it's using a remote connection to mongolab.com)

- clone repository to webroot/httpdocs in apache or nginx environment
- add wedplan.com to hosts file to point locally
- configure apache vhost or nginx server config (nginx config included)
- set up .env file, or request .env from me (contain stripe secret key)
- run 'composer update' to get dependencies


## Nginx server config
```
server {
	listen 127.0.0.1:80;
	server_name wedplan.com www.wedplan.com;

	root home/wedplan.com/public;

	index index.php index.html;

	log_not_found off;
	access_log logs/wedplan.com-access.log;

	charset utf-8;

	location ~ /\. { deny all; }
	location = /favicon.ico { }
	location = /robots.txt { }

	location ~ \.php$ {
		fastcgi_pass 127.0.0.1:9000;
		fastcgi_index index.php;
		fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
		include fastcgi_params;
	}

	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

    location ~ /\.ht {
        deny  all;
    }

}
```

##Tests

Unit tests can be found in the '/tests' folder. 'phpunit' to run all tests. 


##Usage

Test admin account: 
user:admin@intouch.com
pass:abc.123

Test stripe credit cards:
4242424242424242 for success visa payment

For more test credit cards:
Refer to https://stripe.com/docs/testing