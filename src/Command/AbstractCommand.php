<?php
namespace Hamtaro\Command;

use Composer\Script\Event;
use Exception;
use Hamtaro\Core;

/**
 * This class is extended by all Hamtaro terminal commands.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractCommand implements InterfaceCommand
{
    /**
     * Configure the arguments of your command.
     *
     * @return ArgumentConfig[]
     */
    public static function ArgumentConfigs()
    {
        return [];
    }

    /**
     * Check the command inputs.
     *
     * @param array $aInputArguments
     * @return array
     * @throws Exception
     */
    public static function checkArguments(array $aInputArguments)
    {
        error_log(__METHOD__);
        error_log(print_r($aInputArguments, true));
        $aArguments = [];

        foreach (static::ArgumentConfigs() as $ArgumentConfig)
        {
            if ($ArgumentConfig->getName() === '#1')
            {
                if ($ArgumentConfig->isRequired() && (!$aInputArguments || !$mValue = $aInputArguments[0]))
                {
                    throw new Exception("[Missing argument] {$ArgumentConfig->getName()} : {$ArgumentConfig->getDescription()}");
                }

                $sTypeValue = $ArgumentConfig->getTypeValue();
                settype($mValue, $sTypeValue);
                $aArguments[$ArgumentConfig->getName()] = $mValue;
            }
        }

        return $aArguments;
    }

    /**
     * @inheritDoc
     * @throws Exception
     * @see InterfaceCommand::run()
     */
    public static function run(Event $Event)
    {
        $aArguments = static::checkArguments($Event->getArguments());
        $sCtrl = $aArguments[0] ?? '';

        if (!$sCtrl)
        {
            throw new Exception("Argument #1 is required : CamelCaseName");
        }

        (new Core)->Workflow()->createController($sCtrl, static::getSrcTarget(), static::getTemplates());
    }
}