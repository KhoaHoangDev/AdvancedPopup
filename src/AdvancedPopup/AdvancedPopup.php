<?php
/**
 * Created by PhpStorm.
 * User: khoan
 * Date: 4/17/2016
 * Time: 2:47 PM
 */

namespace AdvancedPopup;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\config;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\TextFormat;

use pocketmine\plugin\PluginManager;
use pocketmine\plugin\Plugin;

class AdvancedPopup extends PluginBase implements Listener{

    public $config;
    /**
     *
     */
    public function onLoad(){
        $this->getLogger()->info(TextFormat::RED."Begin loading AdvancedPopup v1.01...");
        $this->getLogger()->info(TextFormat::RED."Loading Colored Formats...");
        // TextFormat class :)
        $this->getLogger()->info(TextFormat::RED."Waiting for other plugins to load...");
    }

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info(TextFormat::RED."Loading and reading config.yml");
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->config = new Config ($this->getDataFolder() . "config.yml" , Config::YAML, array(
            "Join" => "[player] joined the game!",
            "Quit" => "[player] left the game!",
            "DeathPopup-Enabled" => "true",
            "DeathPopup" => "[player] was killed!",
        ));
        $this->saveResource("config.yml");
        $this->getLogger()->info(TextFormat::GREEN."AdvancedPopup Enabled! Made by KhoaHoang.");
    }
    public function onJoin(PlayerJoinEvent $join, PlayerDeathEvent $deathEvent){
        $pjoin = $join->getPlayer();
        $name = $pjoin->getName();
        $join->setJoinMessage("");
        $joinpopup = str_replace("[player]", $name, $this->config->get("Join"));
        $this->getServer()->broadcastPopup($joinpopup);
        if ($this->getDataFolder() . "config.yml". Config::YAML. array("DeathPopup-Enabled" => "true",)){
        $pdead = $deathEvent->getEntity();
        $name = $pdead->getName();
        $death->setDeathMessage("");
        $deathpopup = str_replace("[player]", $name, $this->config->get("DeathPopup"));
        $this->getServer()->broadcastPopup($deathpopup);
    }
        }

    public function onQuit(PlayerQuitEvent $quit){
            $pquit = $quit->getPlayer();
            $name = $pquit->getName();
            $quit->setQuitMessage("");
            $quitpopup = str_replace("[player]", $name, $this->config->get("quit"));
            $this->getServer()->broadcastPopup($quitpopup);
    }
    
}