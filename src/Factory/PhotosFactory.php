<?php

namespace App\Factory;

use App\Entity\Photos;
use App\Repository\PhotosRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Photos>
 *
 * @method static Photos|Proxy createOne(array $attributes = [])
 * @method static Photos[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Photos|Proxy find(object|array|mixed $criteria)
 * @method static Photos|Proxy findOrCreate(array $attributes)
 * @method static Photos|Proxy first(string $sortedField = 'id')
 * @method static Photos|Proxy last(string $sortedField = 'id')
 * @method static Photos|Proxy random(array $attributes = [])
 * @method static Photos|Proxy randomOrCreate(array $attributes = [])
 * @method static Photos[]|Proxy[] all()
 * @method static Photos[]|Proxy[] findBy(array $attributes)
 * @method static Photos[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Photos[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PhotosRepository|RepositoryProxy repository()
 * @method Photos|Proxy create(array|callable $attributes = [])
 */
final class PhotosFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Photos $photos): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Photos::class;
    }
}
