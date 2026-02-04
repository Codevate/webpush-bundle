<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services();
    $parameters = $container->parameters();

    $services->set(\BenTools\WebPushBundle\Command\WebPushGenerateKeysCommand::class, \BenTools\WebPushBundle\Command\WebPushGenerateKeysCommand::class)
        ->tag('console.command');

    $services->set(\BenTools\WebPushBundle\Twig\WebPushTwigExtension::class, \BenTools\WebPushBundle\Twig\WebPushTwigExtension::class)
        ->args(['%bentools_webpush.vapid_public_key%'])
        ->tag('twig.extension');

    $services->set(\BenTools\WebPushBundle\Model\Subscription\UserSubscriptionManagerRegistry::class, \BenTools\WebPushBundle\Model\Subscription\UserSubscriptionManagerRegistry::class);

    $services->alias(\BenTools\WebPushBundle\Model\Subscription\UserSubscriptionManagerInterface::class, \BenTools\WebPushBundle\Model\Subscription\UserSubscriptionManagerRegistry::class);

    $services->set(\BenTools\WebPushBundle\Action\RegisterSubscriptionAction::class, \BenTools\WebPushBundle\Action\RegisterSubscriptionAction::class)
        ->public()
        ->args([service(\BenTools\WebPushBundle\Model\Subscription\UserSubscriptionManagerRegistry::class)])
        ->tag('controller.service_arguments');

    $services->set(\BenTools\WebPushBundle\Sender\PushMessageSender::class, \BenTools\WebPushBundle\Sender\PushMessageSender::class)
        ->args([['VAPID' => ['subject' => '%bentools_webpush.vapid_subject%', 'publicKey' => '%bentools_webpush.vapid_public_key%', 'privateKey' => '%bentools_webpush.vapid_private_key%']]]);
};
