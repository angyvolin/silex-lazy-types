<?php

namespace Angyvolin\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LazyTypesProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['form.types.lazy'] = function () {
            return [];
        };

        $app->extend('form.extensions', function ($extensions, Container $app) {
            $extensions[] = new LazyTypesExtension($app, $app['form.types.lazy']);

            return $extensions;
        });
    }
}
