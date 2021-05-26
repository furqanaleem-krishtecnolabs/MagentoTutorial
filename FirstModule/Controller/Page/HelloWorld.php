<?php
namespace SimplifiedMagento\FirstModule\Controller\Page;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use SimplifiedMagento\FirstModule\Api\PencilInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use SimplifiedMagento\FirstModule\Model\PencilFactory;
use Magento\Catalog\Model\ProductFactory;


class HelloWorld extends \Magento\Framework\App\Action\Action
{
    protected $pencilInterface;
    protected $productRepository;
    protected $pencilFactory;
    protected $productFactory;
    public function __construct(Context $context,
                                ProductFactory $productFactory,
                                PencilFactory $pencilFactory,
                                PencilInterface $pencilInterface,
                                ProductRepositoryInterface $productRepository)
    {
        $this->pencilInterface=$pencilInterface;
        $this->productRepository=$productRepository;
        $this->pencilFactory=$pencilFactory;
        $this->productFactory=$productFactory;
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
        echo "Main function";

    }
}