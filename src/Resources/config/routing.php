<?php

use BenTools\WebPushBundle\Action\RegisterSubscriptionAction;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('bentools_webpush.subscription', '/')
        ->controller(RegisterSubscriptionAction::class)
        ->methods(['POST', 'DELETE']);
};
