<?php
declare(strict_types=1);

namespace shelly7w7\globalmute;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;

class MuteListener implements Listener{

	public function __construct(Loader $plugin)
	{
		$this->plugin = $plugin;
	}

	public function onChat(PlayerChatEvent $event)
	{
		if($this->plugin->config->get("global-mute") == true and !($event->getplayer()->hasPermission("global.mute.chat"))){
			$event->setCancelled();
            $event->getPlayer()->sendMessage($this->plugin->config->get("chat-error"));
		}
	}
}

