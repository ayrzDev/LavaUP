<?php

namespace Ayrz;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\scheduler\Task;

class LavaupTask extends Task{

    public $time = 61;
    public $taskid;

    public function __construct(Main $plugin,$player){
        $this->plugin = $plugin;
        $this->player = $player;
        $this->cfg = new Config($this->plugin->getDataFolder()."Lavaup.yml", Config::YAML);
    }//construct

    public function onRun(int $currentTick){            
        if($this->player instanceof Player){

            if($this->cfg->get("Status") == true){
            $this->player->sendPopup("Second: ".$this->time);
            $this->taskid = $this->getTaskId();
            $this->time--;
            if($this->time == 60){
                $this->player->sendMessage("1 minute left for the lava to rise one more layer.");
            }
            if($this->time == 0){
                /**
                 * 1x 142
                 * 2x 174
                 * y1
                 * 1z 157
                 * 2z 189
                 */
                $this->cfg->set("y", $this->cfg->get("y") + 1 );
                $this->cfg->save();
                for($x = $this->cfg->get("x1"); $x < $this->cfg->get("x2"); $x++) {
                      for($z = $this->cfg->get("z1"); $z < $this->cfg->get("z2"); $z++) {
                     $y = $this->cfg->get("y");
                        $this->player->getLevel()->setBlock(new Vector3($x, $y, $z), Block::get(Block::LAVA));

                      }
                    
                  }
                $this->plugin->getScheduler()->scheduleRepeatingTask(new LavaupTask($this->plugin,$this->player), 20 * 1);
                $this->taskid = $this->getTaskId();
                $this->plugin->getScheduler()->cancelTask($this->getTaskId());
            }
        }else{
            $this->plugin->getScheduler()->cancelTask($this->getTaskId());
        }
        }
    
    
    }

    public function cancel(){
        $this->plugin->getScheduler()->cancelTask($this->getTaskId());
    }

}//class

?>
