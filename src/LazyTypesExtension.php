<?php

namespace Angyvolin\Provider;

use Pimple\Container;
use Symfony\Component\Form\FormExtensionInterface;
use Symfony\Component\Form\FormTypeInterface;

class LazyTypesExtension implements FormExtensionInterface
{
    private $container;

    private $typeServiceIds;

    /**
     * @param Container $container
     * @param string[] $typeServiceIds
     */
    public function __construct(Container $container, array $typeServiceIds)
    {
        $this->container = $container;
        $this->typeServiceIds = $typeServiceIds;
    }

    /**
     * @param string $name
     *
     * @return FormTypeInterface $type
     *
     * @throws \InvalidArgumentException
     */
    public function getType($name)
    {
        if (!$this->hasType($name)) {
            throw new \InvalidArgumentException(
                sprintf('The field type "%s" is not registered with the service container.', $name)
            );
        }

        $serviceId = (string) $this->typeServiceIds[$name];

        return $this->container[$serviceId];
    }

    public function hasType($name)
    {
        return array_key_exists($name, $this->typeServiceIds);
    }

    public function getTypeExtensions($name)
    {
        return [];
    }

    public function hasTypeExtensions($name)
    {
        return false;
    }

    public function getTypeGuesser()
    {
        return null;
    }
}
