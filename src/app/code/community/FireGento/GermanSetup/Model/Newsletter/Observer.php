<?php
/**
 * This file is part of the FIREGENTO project.
 *
 * FireGento_GermanSetup is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 3 as
 * published by the Free Software Foundation.
 *
 * This script is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * PHP version 5
 *
 * @category  FireGento
 * @package   FireGento_GermanSetup
 * @author    FireGento Team <team@firegento.com>
 * @copyright 2012 FireGento Team (http://www.firegento.de). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     1.1.4
 */
/**
 * Observer class
 *
 * @category  FireGento
 * @package   FireGento_GermanSetup
 * @author    FireGento Team <team@firegento.com>
 * @copyright 2012 FireGento Team (http://www.firegento.de). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     1.1.4
 */
class FireGento_GermanSetup_Model_Newsletter_Observer
{
    /**
     * Enter description here ...
     *
     * @param Varien_Event_Observer $observer
     * @event newsletter_subscriber_save_after
     * @return void
     */
    public function saveSubscriberStatusHistory(Varien_Event_Observer $observer)
    {
        try {
            /* @var $subscriber Mage_Newsletter_Model_Subscriber */
            $subscriber = $observer->getEvent()->getSubscriber();

            /* @var $status FireGento_GermanSetup_Model_Newsletter_Subscriber_Status */
            $status = Mage::getModel('germansetup/newsletter_subscriber_status');
            $status->setData('subscriber', $subscriber->getId());
            $status->setData('status', $subscriber->getData('subscriber_status'));
            $status->setData('email', $subscriber->getData('subscriber_email'));
            $status->setData('created_at', now());
            $status->save();
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }
}
