<?php
namespace Hamtaro\Module;

use Hamtaro\Controller\Modal\AbstractModal;

/**
 * Modals module.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Modals extends AbstractModule
{
    /**
     * Modal to display after page load.
     *
     * @var AbstractModal $afterloading
     */
    private AbstractModal $afterloading;

    /**
     * Defines the modal to display at the end of the page load.
     *
     * @return void
     */
    public function showThisAfterLoading(AbstractModal $modal)
    {
        $this->afterloading = $modal;
    }

    /**
     * Returns the modal to display at the end of the page load.
     *
     * @return AbstractModal
     */
    public function getAfterLoading()
    {
        return $this->afterloading;
    }
}