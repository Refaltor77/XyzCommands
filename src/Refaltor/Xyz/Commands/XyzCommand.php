<?php

namespace Refaltor\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Refaltor\Xyz\Xyz;

class XyzCommand extends Command
{
    public static array $isInXyz = [];
    private Xyz $plugin;

    public function __construct(Xyz $plugin, string $name, Translatable $description, ?Translatable $usageMessage = null, array $aliases = [])
    {
        $this->plugin = $plugin;
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if (!isset(self::$isInXyz[$sender->getUniqueId()->getBytes()])) {
                self::$isInXyz[$sender->getUniqueId()->getBytes()] = true;
                $sender->sendMessage(str_replace('{player}', $sender->getName(), $this->plugin->getOnMsg()));
            } else {
                unset(self::$isInXyz[$sender->getUniqueId()->getBytes()]);
                $sender->sendMessage(str_replace('{player}', $sender->getName(), $this->plugin->getOffMsg()));
            }
        }
    }
}