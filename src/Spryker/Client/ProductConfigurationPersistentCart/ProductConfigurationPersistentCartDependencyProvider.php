<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductConfigurationPersistentCart;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\ProductConfigurationPersistentCart\Dependency\Client\ProductConfigurationPersistentCartToProductConfigurationStorageClientBridge;

class ProductConfigurationPersistentCartDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_PRODUCT_CONFIGURATION_STORAGE = 'CLIENT_PRODUCT_CONFIGURATION_STORAGE';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addProductConfigurationStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addProductConfigurationStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_PRODUCT_CONFIGURATION_STORAGE, function (Container $container) {
            return new ProductConfigurationPersistentCartToProductConfigurationStorageClientBridge(
                $container->getLocator()->productConfigurationStorage()->client(),
            );
        });

        return $container;
    }
}
