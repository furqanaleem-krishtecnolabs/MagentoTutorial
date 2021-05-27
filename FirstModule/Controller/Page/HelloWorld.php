<?php
namespace SimplifiedMagento\FirstModule\Controller\Page;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use SimplifiedMagento\FirstModule\Api\PencilInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use SimplifiedMagento\FirstModule\Model\PencilFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\App\Request\Http;
use SimplifiedMagento\FirstModule\Model\HeavyService;
class HelloWorld extends \Magento\Framework\App\Action\Action
{
    protected $pencilInterface;
    protected $productRepository;
    protected $pencilFactory;
    protected $productFactory;
    protected $managerInterface;
    protected $http;
    protected  $heavyService;
    public function __construct(Context $context,
                                HeavyService $heavyService,
                                Http $http,
                                ManagerInterface $managerInterface,
                                ProductFactory $productFactory,
                                PencilFactory $pencilFactory,
                                PencilInterface $pencilInterface,
                                ProductRepositoryInterface $productRepository)
    {
        $this->pencilInterface=$pencilInterface;
        $this->productRepository=$productRepository;
        $this->pencilFactory=$pencilFactory;
        $this->productFactory=$productFactory;
        $this->managerInterface=$managerInterface;
        $this->http=$http;
        $this->heavyService=$heavyService;
        parent::__construct($context);
    }
    public function execute()
    {
//         echo $this->pencilInterface->getPencilType();
//        echo get_class($this->productRepository);
//        $objecctManager=\Magento\Framework\App\ObjectManager::getInstance();
//        $pencil=$objecctManager->create('SimplifiedMagento\FirstModule\Model\Pencil');
//        var_dump($pencil);

//        $book=$objecctManager->create('SimplifiedMagento\FirstModule\Model\Book');
//        $student=$objecctManager->create('SimplifiedMagento\FirstModule\Model\Student');
//        var_dump($student);
//        $pencil=$objecctManager->create('SimplifiedMagento\FirstModule\Model\Pencil');
//        var_dump($pencil);
//        $pencil=$this->pencilFactory->create(array("name"=>"Alex","school"=>"School"));
//        var_dump($pencil);
//        $product=$this->productFactory->create()->load(1);
//        $product->setName('Iphone 6');
//        $productName=$product->getName();
//        echo $productName;
//        echo "Main function";
//            $message=new \Magento\Framework\DataObject(array("greeting"=>"GoodMorning"));
//            $this->managerInterface->dispatch('custom_event',['greeting'=>$message]);
//            echo $message->getGreeting();
        $id=$this->http->getParam('id',0);
        if($id==1){
            $this->heavyService->printHeavyServiceMessage();
        }else{
            echo "heavy service not used";
        }

    }
}