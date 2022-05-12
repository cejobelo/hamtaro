<?php
namespace Hamtaro\Command;

use Composer\Script\Event;

/**
 * A script.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractCommand
{
    /**
     * Run the script.
     *
     * @param Event $Event
     * @return void
     */
    abstract static public function run(Event $Event);
}