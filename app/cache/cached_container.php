<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * cached_container
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class cached_container extends Container
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();

        $this->set('service_container', $this);

        $this->scopes = array();
        $this->scopeChildren = array();
    }

    /**
     * Gets the 'context' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Routing\RequestContext A Symfony\Component\Routing\RequestContext instance.
     */
    protected function getContextService()
    {
        return $this->services['context'] = new \Symfony\Component\Routing\RequestContext();
    }

    /**
     * Gets the 'dispatcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\EventDispatcher\EventDispatcher A Symfony\Component\EventDispatcher\EventDispatcher instance.
     */
    protected function getDispatcherService()
    {
        $this->services['dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\EventDispatcher();

        $instance->addSubscriber($this->get('listener.router'));
        $instance->addSubscriber($this->get('listener.timer'));

        return $instance;
    }

    /**
     * Gets the 'http_kernel' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\HttpKernel A Symfony\Component\HttpKernel\HttpKernel instance.
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\HttpKernel($this->get('dispatcher'), $this->get('resolver'));
    }

    /**
     * Gets the 'http_kernel.cache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\HttpCache\HttpCache A Symfony\Component\HttpKernel\HttpCache\HttpCache instance.
     */
    protected function getHttpKernel_CacheService()
    {
        return $this->services['http_kernel.cache'] = new \Symfony\Component\HttpKernel\HttpCache\HttpCache($this->get('http_kernel'), $this->get('httpcache.store'));
    }

    /**
     * Gets the 'httpcache.store' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\HttpCache\Store A Symfony\Component\HttpKernel\HttpCache\Store instance.
     */
    protected function getHttpcache_StoreService()
    {
        return $this->services['httpcache.store'] = new \Symfony\Component\HttpKernel\HttpCache\Store('/home/tino/sites/sliced/app/cache/httpcache');
    }

    /**
     * Gets the 'listener.router' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\RouterListener A Symfony\Component\HttpKernel\EventListener\RouterListener instance.
     */
    protected function getListener_RouterService()
    {
        return $this->services['listener.router'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($this->get('matcher'));
    }

    /**
     * Gets the 'listener.timer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sliced\EventDispatcher\Subscribers\Timer A Sliced\EventDispatcher\Subscribers\Timer instance.
     */
    protected function getListener_TimerService()
    {
        return $this->services['listener.timer'] = new \Sliced\EventDispatcher\Subscribers\Timer();
    }

    /**
     * Gets the 'matcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return cached_matcher A cached_matcher instance.
     */
    protected function getMatcherService()
    {
        return $this->services['matcher'] = new \cached_matcher($this->get('context'));
    }

    /**
     * Gets the 'resolver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\Controller\ControllerResolver A Symfony\Component\HttpKernel\Controller\ControllerResolver instance.
     */
    protected function getResolverService()
    {
        return $this->services['resolver'] = new \Symfony\Component\HttpKernel\Controller\ControllerResolver();
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!array_key_exists($name, $this->parameters)) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        return array_key_exists(strtolower($name), $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritDoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }
    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'debug' => true,
            'context_class' => 'Symfony\\Component\\Routing\\RequestContext',
            'matcher_class' => 'Symfony\\Component\\Routing\\Matcher\\UrlMatcher',
            'matcher_class_optimized' => 'cached_matcher',
            'resolver_class' => 'Symfony\\Component\\HttpKernel\\Controller\\ControllerResolver',
        );
    }
}
