<?php


namespace Practice\Menu\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class TopMenuHtmlGetAfter implements ObserverInterface
{
    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $layout;

    /**
     * @param \Magento\Framework\View\LayoutInterface $layout
     */
    public function __construct(
        \Magento\Framework\View\LayoutInterface $layout
    )
    {
        $this->layout=$layout;
    }

    /**
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        $trnsportObject=$observer->getEvent()->getData('transportObject');
        if($trnsportObject){
            $textLinkHtml=$this->layout->createBlock('Magento\Framework\View\Element\Template')
                ->setTemplate('Practice_Menu::html/topmenu.phtml')->toHtml();
            $topmenuHtml=$trnsportObject->getHtml().$textLinkHtml;
            $trnsportObject->setHtml($topmenuHtml);
        }
        return $this;
    }
}