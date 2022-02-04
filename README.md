# api-request-logger
Log API requests

This is a minimal package to log all incoming requests towards your application and save them. it's a small package and it's easy to install.

How to install?

Take following steps to install the package.

# Step #1
Install the package from Composer.

``composer require custplace/request-logger``

# Step #2
Publish configuration file and configure your own collection name and driver name

``php artisan vendor:publish``

# Step #3
After steps above, by default all your routes will be under a specific middelware, so no need to apply any kind of additional configuration on routes.

You can now test the package by visiting /test.

You can disable package by sitting enabled function in configuration file to false.

And you're done!

Now every request that goes through your application will be logged and saved inside the collection you already specified in configuration file.

Thanks for using this package and I hope it'll help you in your further applications.