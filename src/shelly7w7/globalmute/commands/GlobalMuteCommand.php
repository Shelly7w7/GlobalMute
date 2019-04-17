<?php
declare(strict_types=1);
namespace shelly7w7\globalmute\commands;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat as TF;
use pocketmine\command\PluginCommand;
use shelly7w7\globalmute\Loader;
class GlobalMuteCommand extends PluginCommand implements Listener {
	public function __construct($name, Loader $plugin)
    {
        parent::__construct($name, $plugin);
        $this->plugin = $plugin;   
        $this->setAliases(["gm"]);
        $this->setDescription("Enable/Disable Global Mute.");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
    	if($sender->hasPermission("global.mute")){
    	 if (count($args) < 1) {
                $sender->sendMessage("Invalid usage. /globalmute (on/off)");
                 return true;
                 }
                 if (isset($args[0])) {
                 switch ($args[0]) {
                 	case "on":
                 	 $this->plugin->getServer()->broadcastMessage($this->plugin->config->get("turned-on"));
                 	 $this->plugin->config->set("global-mute", true);
                 	 $this->plugin->config->save();
                 	 break;
                 	 case "off":
                 	 $this->plugin->getServer()->broadcastMessage($this->plugin->config->get("turned-off"));
                 	 $this->plugin->config->set("global-mute", false);
                 	 $this->plugin->config->save();
                 	 break;
                 	}
                 	} else {
          $sender->sendMessage("Invalid usage. /globalmute (on/off)");
        }
    }else{
         $sender->sendMessage(TF::RED . "You don't have permission to use this command.");
     }

   }

 }

