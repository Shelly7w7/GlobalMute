<?php

declare(strict_types=1);

namespace shelly7w7\globalmute;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class MuteListener implements Listener{

	public function onChat(PlayerChatEvent $event) : void{
		$player = $event->getPlayer();
		if(Loader::getInstance()->config->get("global-mute") === true && !($player->hasPermission("global.mute.chat"))){
			$event->setCancelled();
			$player->sendMessage(Loader::getInstance()->config->get("chat-error"));
		}
	}
}