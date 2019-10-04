<?php
declare(strict_types=1);

namespace shelly7w7\globalmute;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use function str_repeat;

class GlobalMute extends PluginBase implements Listener{

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        $action = $args[0] ?? "";
        if($action === "on" || $action === "off"){
            $config = $this->getConfig();
            $config->set("global-mute", $action === "on");
            if($action === "on" && $config->get("clear-chat") === true){
                $this->getServer()->broadcastMessage(str_repeat("\n", 100));
            }
            $this->getServer()->broadcastMessage($config->get("turned-" . $action, "Global mute has been toggled " . $action . "."));

            return true;
        }
        $sender->sendMessage(TextFormat::RED . "Use '/globalmute <on|off>'");

        return false;
    }

    public function onPlayerChat(PlayerChatEvent $event){
        $config = $this->getConfig();
        if($config->get("global-mute") === true && !$event->getPlayer()->hasPermission("global.mute.chat")){
            $event->setCancelled();
            $event->getPlayer()->sendMessage($config->get("chat-error", "You cannot chat while global mute is toggled on."));
        }
    }
}