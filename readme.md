# Easy Model Gates

This packages allows authorized access to model attributes, so by using the Laravel Gates and Policies, 
you can reduce the data returned based on authorisation.

## Install

Pull this package in through Composer.

```js
{
    "require": {
        "relaxsd/laravel-model-gates": "0.1.*"
    }
}
```

## Usage

Here's an example of a model gate.

```php
use Relaxsd\Gate\ModelGate;

class ProjectGate extends ModelGate {

    public function members()
    {
        if (\Gate::allows('indexForProject', [\App\Member::class, $this->entity])) {
            return $this->entity->members;
        }
        return new \Illuminate\Database\Eloquent\Collection(); // Not authorized: return an empty collection instead. 
    }

}
```

Next, on your entity, pull in the `Relaxsd\Gate\ModelGateTrait` trait, which will automatically instantiate your model gate class.

Here's an example - maybe a Laravel `User` model.

```php
<?php

use Relaxsd\Gate\ModelGateTrait;

class Project extends \Eloquent {

    use ModelGateTrait;

    protected $gate = 'ProjectGate';

}
```

That's it! You're done. Now, within your code, you can do:

```php
    return $project->gate()->members; // Only the members we're allowed to see
```

Notice how the call to the `gate()` method (which will return your new or cached model gate object) also provides the benefit of making it perfectly clear where you must go, should you need to modify the implementation.

Have fun!
