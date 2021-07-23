<?php


namespace Practice\SalesOrder\Plugin\Button;


use Magento\Backend\Block\Widget\Button\Toolbar\Interceptor;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Backend\Block\Widget\Button\ButtonList;

class ToolbarPlugin
{
    /**
     * @param \Magento\Backend\Block\Widget\Button\Toolbar\Interceptor $subject
     * @param \Magento\Framework\View\Element\AbstractBlock $context
     * @param \Magento\Backend\Block\Widget\Button\ButtonList $buttonList
     * @return void
     */
    public function beforePushButtons(
        Interceptor $subject,
        AbstractBlock $context,
        ButtonList $buttonList
    )
    {
        $nameInLayout = $context->getNameInLayout();
        $invoice = false;
        // Check if the current page is the invoice detail page
        if ($nameInLayout == 'sales_invoice_view') {
            $invoice = $context->getInvoice();
            $message = __('Are you sure you want to do this?');
            $params = [
                'invoice_id' => $invoice->getId()
            ];

            $url = $context->getUrl('practice_sales_order/invoice/pdfemail', $params);

            $buttonList->add(
                'send_pdf_invoice_email',
                [
                    'label' => __('Send a PDF Invoice Email'),
                    'class' => 'send-pdf-invoice-email',
                    'onclick' => "confirmSetLocation('{$message}', '{$url}')"
                ],
                -1
            );
        }
    }
}