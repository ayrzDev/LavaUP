<?php

namespace Ayrz;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\block\Block;
use pocketmine\utils\Config;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;

use Ayrz\LavaupCommand;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Lavaup plugin enable");
        $this->cfg = new Config($this->getDataFolder()."Lavaup.yml", Config::YAML);
        $this->cfg->set("x1", "142");
        $this->cfg->set("x2", "174");
        $this->cfg->set("z1", "157");
        $this->cfg->set("z2", "189");
        $this->cfg->set("y", "1");
        $this->cfg->save();

         /**
         * 1x 142
         * 2x 174
         * y1
         * 1z 157
         * 2z 189
         */

        $this->getServer()->getCommandMap()->register("lavaup", new LavaupCommand($this));
    }

    public function onDisable(){
        $this->getLogger()->info("Lavaup plugin disable");
    }

}//class



?>
