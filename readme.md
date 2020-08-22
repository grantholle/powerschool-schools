# PowerSchool Schools Boilerplate

This package is meant to jumpstart a Laravel project to include school support out of the box. It includes a migration, model and command to populate the table.

## Installation

```
composer require grantholle/powerschool-schools
```

### Migration

To publish the migration included, run:

```
php artisan vendor:publish --provider="GrantHolle\PowerSchool\Schools\PowerSchoolSchoolsServiceProvider"
```

### Model

This package includes `GrantHolle\PowerSchool\Schools\Models\School`. You'll want to generate your own `App\School` (or whatever) model that extends the base `School` model.

```php
<?php

namespace App;

use GrantHolle\PowerSchool\Schools\Models\School as BaseSchool;

class School extends BaseSchool
{
    // Your stuff
}
```

## Commands

There is a single command that is included which syncs the schools from your PowerSchool instance using the `/ws/v1/district/school` endpoint.

It does this using the [grantholle/powerschool-api](https://github.com/grantholle/powerschool-api) package. You will need to [add the config and environment variables](https://github.com/grantholle/powerschool-api#configuration) required for that package.

After that is configured and you have ran the migration to create the `schools` table, you can run:

```
php artisan powerschool:schools
```

to populate the table with the school data for your district.

You can also sync individual schools by passing the `school_number` as a command argument:

```
php artisan powerschool:schools {school_number}
```

## License

[MIT](LICENSE.md)
