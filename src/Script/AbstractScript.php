<?php
namespace Hamtaro\Script;

use Composer\Script\Event;

/**
 * A script.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractScript
{
    /**
     * Run the script.
     *
     * @param Event $Event
     * @return void
     */
    abstract static public function run(Event $Event);
}