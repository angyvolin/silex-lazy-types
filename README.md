# silex-lazy-types
Lazily loads form types defined as services.

## Registering

```php
$app->register(new Angyvolin\Provider\LazyTypesProvider());
```


## Usage

- Define your form type in the service container:
```php
  $app['my_form_service_id'] = $app->factory(function (Container $app) {
      return new MyForm($app['some_myform_dependency']);
  });
```
- Provide a mapping between your form type FQN and it's service id by extending 'form.types.lazy' service:
```php
  $app->extend('form.types.lazy', function ($types) {
      $types[MyForm::class] = 'my_form_service_id';

      return $types;
  });
```
- Use form type FQN while building the form:
```php
  $form = $app['form.factory']
      ->createBuilder(MyForm::class)
      ->getForm();
```

You've done!
Your newly created form type will be instantiated lazily with all needed dependencies during form building process.
