# Timeblocker PHP SDK

### Overview

This is the officially supported development kit for PHP to interface with the [Timeblocker](http://timeblocker.co/ "Timeblocker"). This library takes a couple of design principles from Backbone.js and Laravel and combine them together to create a full REST client for the [Timeblocker API](http://timeblocker.co/docs/api/v1/ "Timeblocker"). Timeblocker has over 100 endpoints for developers, and this library interacts will all them.

- [Getting Started](http://timeblocker.dev/docs/api/getting-started "Getting Started")
- [Endpoint Reference](http://timeblocker.dev/docs/api/v1 "Endpoint Reference")

### Installation

To install this library, it's highly recommended you use [Composer](https://getcomposer.org/ "Composer").

    "require": {
        "timeblocker/timeblocker": "0.9.*"
    }

While the API and SDK are in beta, you must also set your `minimum-stability` paramter to `dev`.

    "minimum-stability": "dev"

If you want to use the Timeblocker SDK without changing your `minimum-stability`, use the `require-dev` parameter.

    "require-dev": {
        "timeblocker/timeblocker": "0.9.*"
    },

### Development Status

Timeblocker API is currently in beta. We are stabilizing the platform and trying to ensure consistency and stability with all the endpoints. We hope to have as minimal breaking changes as possible before the 1.0 release. If you need to use the Timeblocker API in production, we would love to [hear from you](http://timeblocker.co/support/ "Contact Us")

### Authentication

Timeblocker requires authenticating with a user account before making API requests. To authenticate, you need a user's email, password, and API key. This will generate an authentication token which you must pass with all other requests.

	use Timeblocker\Timeblocker;
	use Timeblocker\Models\AuthToken;

	Timeblocker::init(array(
		'account'  => 'yourdomain'
	));

	$token = AuthToken::login(array(
		'email' => 'you@example.com', 
		'password' => 'password',
		'key' => 'yourkey',
		'remember' => 1
	));

	Timeblocker::setAuthToken($token->uid);

	var_dump($token->uid);exit();
