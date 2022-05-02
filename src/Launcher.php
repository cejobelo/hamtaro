<?php
namespace Hamtaro;

use Exception;
use Hamtaro\Controller\Page\Error\Error;

/**
 * The launcher of the Hamtaro framework.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Launcher
{
    /**
     * The constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        try
        { # The Core instance will help us to manage each part of the application
            $Core = new Core;
        }

        catch (Exception $Exception)
        {
            die("Exception when instantiating the Core : {$Exception->getMessage()}");
        }

        try
        { # Launch the Router
            $Core->Router()->run();
        }

        catch (Exception $Exception)
        {
            if ($Exception->getCode() === 2021)
            {
                $Core->Response()->getFailure($Exception->getMessage())->sendAjax();
                die;
            }

            die((new Error($Core, ['Exception' => $Exception]))->getView());
        }
    }
}