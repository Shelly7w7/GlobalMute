<?php

declare(strict_types=1);

namespace shelly7w7\globalmute;

use pocketmine\command\Command;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class GlobalMuteCommand extends Command implements PluginIdentifiableCommand{

	public function __construct(){
		parent::__construct("globalmute", "Enable/Disable Global Mute", "/globalmute (on/off)", ["gm"]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender->hasPermission("global.mute")){
			$sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
			return false;
		}
		if(count($args) < 1){
			$sender->sendMessage("Invalid usage. /globalmute (on/off)");
			return false;
		}
		if(empty($args[0])){
			$sender->sendMessage("Invalid usage. /globalmute (on/off)");
			return false;
		}
		switch($args[0]){
			case "on":
				Loader::getInstance()->toggleGlobalMute(true);
				break;
			case "off":
				Loader::getInstance()->toggleGlobalMute(false);
				break;
		}
		return true;
	}

	public function getPlugin() : Plugin{
		return Loader::getInstance();
	}
}