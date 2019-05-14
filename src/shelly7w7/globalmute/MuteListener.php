<?php

declare(strict_types=1);

namespace shelly7w7\globalmute;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class MuteListener implements Listener{

	/** @var Loader */
	private $plugin;

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}

	public function onChat(PlayerChatEvent $event){
		if($this->plugin->getConfig()->get("global-mute") == true and !($event->getPlayer()->hasPermission("global.mute.chat"))){
			$event->setCancelled();
			$event->getPlayer()->sendMessage($this->plugin->getConfig()->get("chat-error"));
		}
	}
}