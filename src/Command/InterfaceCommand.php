<?php
namespace Hamtaro\Command;

use Composer\Script\Event;

/**
 * Interface for all Hamtaro terminal commands.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
interface InterfaceCommand
{
    /**
     * Run the script.
     *
     * @return void
     */
    public static function run(Event $Event);
}