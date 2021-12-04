<?php

namespace Refaltor\Xyz\Tasks;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use Refaltor\Commands\XyzCommand;
use Refaltor\Xyz\Xyz;

class XyzTask extends Task
{
    private Xyz $plugin;

    public function __construct(Xyz $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(): void
    {
        foreach (XyzCommand::$isInXyz as $uuid => $bool) {
            if ($bool) {
                $player = Server::getInstance()->getPlayerByRawUUID($uuid);
                if ($player instanceof Player) {
                    $player->sendPopup($this->plugin->getXyzMsg($player));
                }
            }
        }
    }
}