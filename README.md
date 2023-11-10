# Countries API

Laravel test project: API for a country database.

## The projects architecture

### The base

This prototype was kick-started with laravel build script and thus follows the typical
Laravel project structure. No additional docker configuration was made. The docker frame
runs with Laravel sail.


## Current state of the API

The API is built according to the RESTful approach and uses versioned routes. 
The route `api/v2/countries` refers to the [App\Http\Controllers\Api\V2\CountryController](app%2FHttp%2FControllers%2FApi%2FV2%2FCountryController.php),
that manages the interactions with countries and chooses the corresponding action based
on the request type. Currently, it reacts on GET to list all countries, and POST to create
a new country record.

The structure of a country and properties that are allowed to be filled are defined in the
[App\Models\Country](app%2FModels%2FCountry.php). However, to ensure that only necessary data is exposed to the user the 
[App\Http\Resources\CountryResource](app%2FHttp%2FResources%2FCountryResource.php)
and the corresponding collection for the list view were introduced.

The validation for the creation process is handled by the 
[App\Http\Requests\V2\StoreCountryRequest](app%2FHttp%2FRequests%2FV2%2FStoreCountryRequest.php),
that currently only requests the attributes to be required. A more detailed validation
should be suggested in a real project (e.g. length or cyrillic for the russian country name).

To ensure that the API always responds in JSON format, even if the requesting side did not set
the correct accept header, the [App\Http\Middleware\ReturnJsonResponseMiddleware](app%2FHttp%2FMiddleware%2FReturnJsonResponseMiddleware.php)
was introduced. It reacts to all CountryController routes. The implementation, however, is
currently just a showcase. The condition could match e.g. all API routes for all versions, or
exclude routes that show documentation.

### Security

No security measures are implemented a.t.m. However, for real projects authentication 
is a must-have at least for create, update and delete actions.

### Testing

For testing of the API the testing framework PHPUnit is used. There is currently only one test 
for the successful creation of a country record.

### Notes on data structure

A requirement of the test project was to have both an incremental id and an uid (which actually
is an uuid). Following assumptions were made based on the requirements:

- The field "id" is an autoincrement, and thus needs to be a primary key.
- The field "uid" is an external unique identifier, because it may be passed in the create request.
This means that in the apps db the uid only needs to be unique and not a key.

## Setup

**Hint**: If running apache, stop the apache service, or change the ports in the docker compose file.

- Build docker images: `sail build --no-cache`
- Start application: `sail up -d`
- Create the database: and run migrations `sail artisan migrate`
- Refresh migrations (if necessary): `sail artisan migrate:refresh`
- Stop application: `sail down`
