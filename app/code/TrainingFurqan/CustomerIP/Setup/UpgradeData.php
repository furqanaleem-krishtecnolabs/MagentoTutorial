<?php


namespace TrainingFurqan\CustomerIP\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @var \Magento\Eav\Model\Config
     */
    private $eavConfig;
    /**
     * @var \Magento\Customer\Model\ResourceModel\Attribute
     */
    private $attributeResource;
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * UpgradeData constructor.
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     * @param \Magento\Eav\Model\Config $eavConfig
     * @param \Magento\Customer\Model\ResourceModel\Attribute $attributeResource
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.5.0', '<')) {
            $this->createCustomerIPAttribute($setup);
        }
        $setup->endSetup();
    }//end upgrade()


    /**
     * create country_code customer attribute
     *
     * @param ModuleDataSetupInterface $setup Setup
     */
    private function createCustomerIPAttribute($setup) : void
    {
        $eavSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $eavSetup->removeAttribute(Customer::ENTITY, "customer_ip_address");

        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

        $eavSetup->addAttribute(Customer::ENTITY, 'customer_ip_address', [
            // Attribute parameters
            'type' => 'varchar',
            'label' => 'Customer IP Address',
            'input' => 'text',
            'required' => false,
            'visible' => true,
            'user_defined' => true,
            'sort_order' => 990,
            'position' => 990,
            'system' => 0,
            'is_used_in_grid'       => true,
            'is_visible_in_grid'    => true,
        ]);

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'customer_ip_address');
        $attribute->setData('attribute_set_id', $attributeSetId);
        $attribute->setData('attribute_group_id', $attributeGroupId);

        /*
        //You can use this attribute in the following forms
        adminhtml_checkout
        adminhtml_customer
        adminhtml_customer_address
        customer_account_create
        customer_account_edit
        customer_address_edit
        customer_register_address
        */

        $attribute->setData('used_in_forms', [
            'adminhtml_customer',
            'customer_account_create',
            // 'customer_account_edit'
        ]);

        $this->attributeResource->save($attribute);
    }//end createDropdownAttribute()
}