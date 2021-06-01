<?php


namespace SimplifiedMagento\RequestFlow\Controller\Page;


use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ActionFactory;
class Router implements RouterInterface

{
    protected $actionFactory;
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory=$actionFactory;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $path=trim($request->getPathInfo(),'/');
        $path=explode('-',$path);
        $request->setModuleName($path[0]);
        $request->setControllerName($path[1]);
        $request->setActionName($path[2]);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward',['request'=>$request]);


    }
}