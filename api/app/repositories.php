<?php
declare(strict_types=1);

use App\Domain\Review\ReviewRepository;
use App\Domain\User\CraftsmanRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Review\MySqlReviewRepository;
use App\Infrastructure\Persistence\User\MySqlCraftsmanRepository;
use App\Infrastructure\Persistence\User\MySqlUserRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => autowire(MySqlUserRepository::class),
    ]);
    $containerBuilder->addDefinitions([
        CraftsmanRepository::class => autowire(MySqlCraftsmanRepository::class),
    ]);
    $containerBuilder->addDefinitions([
        ReviewRepository::class => autowire(MySqlReviewRepository::class),
    ]);
};
