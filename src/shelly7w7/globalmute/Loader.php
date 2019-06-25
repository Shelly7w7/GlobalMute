<?php

declare(strict_types=1);

namespace shelly7w7\globalmute;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Loader extends PluginBase implements Listener{

	/** @var Config $config */
	public $config;
	/** @var self $instance */
	protected static $instance;

	public function onEnable() : void{
		self::$instance = $this;
		@mkdir($this->getDataFolder());
		$this->saveResource('config.yml');
		$this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML);
		$this->getServer()->getCommandMap()->register("globalmute", new GlobalMuteCommand());
		$this->getServer()->getPluginManager()->registerEvents(new MuteListener(), $this);
	}

	public static function getInstance() : self{
		return self::$instance;
	}

	public function toggleGlobalMute(bool $toggle) : void{
		switch($toggle){
			case true:
				$this->getServer()->broadcastMessage($this->config->get("turned-on"));
				$this->config->set("global-mute", true);
				$this->config->save();
				break;
			case false:
				$this->getServer()->broadcastMessage($this->config->get("turned-off"));
				$this->config->set("global-mute", false);
				$this->config->save();
				break;
		}
	}
}