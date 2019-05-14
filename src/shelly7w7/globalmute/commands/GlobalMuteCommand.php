<?php

declare(strict_types=1);

namespace shelly7w7\globalmute\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\plugin\Plugin;

class GlobalMuteCommand extends PluginCommand{

	/** @var Plugin */
	private $plugin;

	public function __construct($name, Plugin $plugin){
		parent::__construct($name, $plugin);
		$this->plugin = $plugin;
		$this->setAliases($this->getPlugin()->getConfig()->get("aliases", []));
		$this->setDescription("Enable/Disable Global Mute.");
		$this->setPermission("global.mute");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}

		if(count($args) < 1){
			throw new InvalidCommandSyntaxException();
		}

		switch($args[0]){
			case "on":
				$this->getPlugin()->getServer()->broadcastMessage($this->getPlugin()->getConfig()->get("turned-on"));
				$this->getPlugin()->getConfig()->set("global-mute", true);
				$this->getPlugin()->getConfig()->save();
				break;
			case "off":
				$this->getPlugin()->getServer()->broadcastMessage($this->getPlugin()->getConfig()->get("turned-off"));
				$this->getPlugin()->getConfig()->set("global-mute", false);
				$this->getPlugin()->getConfig()->save();
				break;
		}

		return true;
	}
}