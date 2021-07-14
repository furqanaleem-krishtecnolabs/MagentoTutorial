<?php


namespace Practice\BannerSlider\Model\Banner\Source;


use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Status implements OptionSourceInterface
{
    /**
     * @var \Practice\BannerSlider\Model\Banner
     */
    protected $banner;

    /**
     * Constructor
     *
     * @param \Practice\BannerSlider\Model\Banner $banner
     */
    public function __construct(\Practice\BannerSlider\Model\Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->banner->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}