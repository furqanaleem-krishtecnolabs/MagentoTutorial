<?php


namespace Practice\CustomLogFile\Logger\Handler;


use Magento\Framework\Filesystem\DriverInterface;

class Customer extends \Magento\Framework\Logger\Handler\Base
{
    protected $loggerType=\Monolog\Logger::DEBUG;

    public function __construct(DriverInterface $filesystem, $filePath = null, $fileName = null)
    {
        $fileName='/var/log/customer-'.date('Y-m-d').'.log';
        parent::__construct($filesystem, $filePath, $fileName);
    }
}