# hello-world-cf

This is the support for a Cloud Foundry workshop.

It covers a wide range of usecases in PHP inside Cloud Foundry and intend to show how to be a [12 factors app](https://12factor.net).

## How to deploy

1. clone this repo or download the zip here: https://github.com/Orange-OpenSource/hello-world-cf/archive/master.zip and unzip this zip
2. go in command line under the folder previously created
3. run `cf push`
4. (*optional*) run the script `bin/create-services.sh` to have redis and mysql binded to your app
5. Open in your favorite browser the app

**Note:** the file [options.json](/.bp-config/options.json) is clearly recommended for all application which use composer

## FAQ (And you should read it to know some other aspect of Cloud Foundry)

### Why it use a php version 5.6 and not php 7.0 ?

The current [php-buildpack](https://github.com/cloudfoundry/php-buildpack/releases/tag/v4.3.18) doesn't have redis extension inside the php 7.0 version.

If you do not use redis here you can change to php version 7.

### Why the file [php.ini](/.bp-config/php/php.ini) is overwrite ?

To change the value of the key `session.name` which is set to `JSESSIONID` by default to `PHPSESSIONID`.

Indeed, `JSESSIONID` create a sticky session with Cloud Foundry. In our example we do not want to use sticky session but use a real session sharing over redis.

### Why the file [php-fpm.conf](/.bp-config/php/php-fpm.conf) is overwrite ?

To uncomment `catch_workers_output = yes` which let us use logging with stdout and stderr in php.