<?php

namespace Refaltor\Xyz;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use Refaltor\Commands\XyzCommand;

class Xyz extends PluginBase
{
    protected function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->getServer()->getCommandMap()->register("xyz", new XyzCommand($this, "xyz", $this->getConfig()->get('commands')['description']));
    }

    public function getOnMsg(): string {
        return $this->getConfig()->get('messages')['on'];
    }

    public function getOffMsg(): string {
        return $this->getConfig()->get('messages')['off'];
    }

    public function getXyzMsg(Player $player): string {
        $pos = $player->getPosition();
        $x = intval($pos->getX());
        $y = intval($pos->getY());
        $z = intval($pos->getZ());
        return str_replace(['{x}', '{y}', '{z}'], [$x, $y, $z], $this->getConfig()->get('xyzMsg'));
    }
}