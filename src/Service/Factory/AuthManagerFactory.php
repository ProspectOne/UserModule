<?php
namespace ProspectOne\UserModule\Service\Factory;

use Interop\Container\ContainerInterface;
use ProspectOne\UserModule\Service\UserManager;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use ProspectOne\UserModule\Service\AuthManager;

/**
 * This is the factory class for AuthManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class AuthManagerFactory implements FactoryInterface
{
    /**
     * This method creates the AuthManager service and returns its instance.
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AuthManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        // Instantiate dependencies.
        $sessionManager = $container->get(SessionManager::class);
        $authenticationService = $container->get(AuthenticationService::class);
        
        // Get contents of 'access_filter' config key (the AuthManager service
        // will use this data to determine whether to allow currently logged in user
        // to execute the controller action or not.
        $config = $container->get('Config');
        if (isset($config['access_filter']))
            $access_filter = $config['access_filter'];
        else
            $access_filter = [];
        $userManager = $container->get(UserManager::class);
        return new AuthManager($authenticationService, $sessionManager, $access_filter, $userManager);
    }
}
