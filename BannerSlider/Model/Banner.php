<?php

namespace UdeyTech\BannerSlider\Model;

use UdeyTech\BannerSlider\Model\Banner\FileInfo;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;

class Banner extends \Magento\Framework\Model\AbstractModel
{
  
    const CACHE_TAG = 'udeytech_banners_slider';

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

  
    protected $_storeManager;

    protected function _construct()
    {
        $this->_init('UdeyTech\BannerSlider\Model\ResourceModel\Banner');
    }

  
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

 
    public function getImageUrl($imageName = null)
    {
        $url = '';
        $image = $imageName;
        if (!$image) {
            $image = $this->getData('image');
        }
        if ($image) {
            if (is_string($image)) {
                $url = $this->_getStoreManager()->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ).FileInfo::ENTITY_MEDIA_PATH .'/'. $image;
            } else {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }

 
    private function _getStoreManager()
    {
        if ($this->_storeManager === null) {
            $this->_storeManager = ObjectManager::getInstance()->get(StoreManagerInterface::class);
        }
        return $this->_storeManager;
    }
}
