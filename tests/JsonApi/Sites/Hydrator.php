<?php

namespace CloudCreativity\LaravelJsonApi\Tests\JsonApi\Sites;

use CloudCreativity\JsonApi\Contracts\Object\RelationshipInterface;
use CloudCreativity\JsonApi\Contracts\Object\ResourceObjectInterface;
use CloudCreativity\JsonApi\Hydrator\AbstractHydrator;
use CloudCreativity\JsonApi\Hydrator\HydratesAttributesTrait;
use CloudCreativity\JsonApi\Utils\Str;
use CloudCreativity\LaravelJsonApi\Tests\Entities\Site;
use CloudCreativity\LaravelJsonApi\Tests\Entities\SiteRepository;

class Hydrator extends AbstractHydrator
{

    use HydratesAttributesTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'domain',
        'name',
    ];

    /**
     * @var SiteRepository
     */
    private $repository;

    /**
     * Hydrator constructor.
     *
     * @param SiteRepository $repository
     */
    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function delete($record)
    {
        $this->repository->remove($record);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function updateRelationship($relationshipKey, RelationshipInterface $relationship, $record)
    {
        // TODO: Implement updateRelationship() method.
    }

    /**
     * @inheritDoc
     */
    public function addToRelationship($relationshipKey, RelationshipInterface $relationship, $record)
    {
        // TODO: Implement addToRelationship() method.
    }

    /**
     * @inheritDoc
     */
    public function removeFromRelationship($relationshipKey, RelationshipInterface $relationship, $record)
    {
        // TODO: Implement removeFromRelationship() method.
    }

    /**
     * @param object $record
     * @param string $attrKey
     * @param mixed $value
     * @return void
     */
    protected function hydrateAttribute($record, $attrKey, $value)
    {
        $method = 'set' . Str::classify($attrKey);

        call_user_func([$record, $method], $value);
    }

    /**
     * @inheritDoc
     */
    protected function createRecord(ResourceObjectInterface $resource)
    {
        return new Site($resource->getId());
    }

    /**
     * @param Site $record
     */
    protected function persist($record)
    {
        $this->repository->store($record);
    }

}
