<?php

declare(strict_types=1);

namespace shelly7w7\globalmute;

use pocketmine\plugin\PluginBase;
use shelly7w7\globalmute\commands\GlobalMuteCommand;

class Loader extends PluginBase{

	public function onEnable(){
		$this->saveResource('config.yml');
		$this->getServer()->getCommandMap()->register($this->getName(), new GlobalMuteCommand("globalmute", $this));
		$this->getServer()->getPluginManager()->registerEvents(new MuteListener($this), $this);
	}
}