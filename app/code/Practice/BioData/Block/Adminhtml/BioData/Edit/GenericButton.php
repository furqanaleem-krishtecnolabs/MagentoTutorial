<?php


namespace Practice\BioData\Block\Adminhtml\BioData\Edit;


use Magento\Backend\Block\Widget\Context;
use Practice\BioData\Api\BioDataRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;

    protected $bioDataRepository;

    public function __construct(
        Context $context,
        BioDataRepositoryInterface $bioDataRepository
    ) {
        $this->context = $context;
        $this->bioDataRepository = $bioDataRepository;
    }

    public function getId()
    {
        try {
            return $this->bioDataRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}