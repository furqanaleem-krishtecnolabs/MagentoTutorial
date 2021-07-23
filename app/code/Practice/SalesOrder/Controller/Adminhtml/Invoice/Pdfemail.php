<?php


namespace Practice\SalesOrder\Controller\Adminhtml\Invoice;



class Pdfemail extends \Magento\Backend\App\Action
{
    const XML_PATH_SALES_EMAIL_INVOICE_PDF_TEMPLATE = 'sales_email/invoice/pdf_template';
    const XML_PATH_SALES_EMAIL_INVOICE_INDENTITY = 'sales_email/invoice/identity';

    /**
     * Send a PDF invoice email to a customer from backend
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $invoiceId = (int)$this->getRequest()->getParam('invoice_id');
            $invoice = $this->_objectManager->get(\Magento\Sales\Model\Order\InvoiceRepository::class)->get($invoiceId);
            $order = $invoice->getOrder();
            $storeId = $order->getStoreId();
            $customerEmail = $order->getCustomerEmail();

            $templateId = $this->_objectManager->get(
                \Magento\Framework\App\Config\ScopeConfigInterface::class
            )->getValue(
                self::XML_PATH_SALES_EMAIL_INVOICE_PDF_TEMPLATE,
                'store',
                $storeId
            );

            /** @var array $from */
            $from = $this->_objectManager->get(\Magento\Framework\Mail\Template\SenderResolverInterface::class)->resolve(
                $this->_objectManager->get(
                    \Magento\Framework\App\Config\ScopeConfigInterface::class
                )->getValue(self::XML_PATH_SALES_EMAIL_INVOICE_INDENTITY, 'store', $storeId),
                $storeId
            );

            $templateParams = [
                'invoice' => $invoice,
                'order' => $order,
                'store' => $this->_objectManager->get(\Magento\Store\Model\StoreManagerInterface::class)->getStore($storeId),
                'customer_name' => trim($order->getData('customer_firstname').' '.$order->getData('customer_lastname'))
            ];

            $invoiceCollection = $this->_objectManager->get(\Magento\Sales\Model\ResourceModel\Order\Invoice\Collection::class)->addFieldToFilter('entity_id', $invoice->getId())->load();

            // Starting on sending an email
            $transport = $this->_objectManager->get(\Magento\Framework\Mail\Template\TransportBuilder::class)
                ->setTemplateIdentifier($templateId)
                ->setTemplateOptions(['area' => 'frontend', 'store' => $storeId])
                ->setTemplateVars($templateParams)
                ->setFrom($from)
                ->addTo($customerEmail, trim($order->getCustomerFirstname().' '.$order->getCustomerLastname()))
                ->getTransport();

            $transport = $this->addAttachment(
                $transport,
                $this->generatePdfInvoice($invoiceCollection),
                'invoice'.$invoice->getIncrementId().'.pdf'
            );

            $transport->sendMessage();

            $this->messageManager->addSuccess(__('You sent an email to the customer email %1 to succeed.', $customerEmail));
        } catch(\Exception $e) {
            $this->messageManager->addError(__('Can not send an email.'));
            $this->messageManager->addError($e->getMessage());
        }

        $redirectUrl = $this->_url->getUrl('sales/invoice/view', ['invoice_id' => $invoiceId]);

        $this->getResponse()->setRedirect($redirectUrl);
    }

    /**
     * Generate the PDF invoice
     *
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return string
     */
    public function generatePdfInvoice($invoice)
    {
        $pdf = $this->_objectManager->get(\Magento\Sales\Model\Order\Pdf\Invoice::class)->getPdf($invoice);
        return $pdf->render();
    }

    /**
     * Attach the pdf to email
     * This is the function for adding an attachment to the email
     *
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transport
     * @param string $pdfString
     * @param string $pdfFileName
     * @return \Magento\Framework\Mail\Template\TransportBuilder
     */
    public function addAttachment($transport, $pdfString, $pdfFileName)
    {
        $attachment = $this->_objectManager->get(\Zend\Mime\PartFactory::class)->create();
        $attachment->setContent($pdfString)
            ->setType('application/pdf')
            ->setFileName($pdfFileName)
            ->setDisposition(\Zend_Mime::DISPOSITION_ATTACHMENT)
            ->setEncoding(\Zend_Mime::ENCODING_BASE64);

        $bodyHtml = $this->_objectManager->get(\Zend\Mime\PartFactory::class)->create();
        $bodyHtml->setContent($transport->getMessage()->getBody()->generateMessage())
            ->setType('text/html');

        $bodyPart = $this->_objectManager->get(\Zend\Mime\Message::class);
        $bodyPart->addPart($bodyHtml);
        $bodyPart->addPart($attachment);
        $transport->getMessage()->setBody($bodyPart);
        return $transport;
    }
}