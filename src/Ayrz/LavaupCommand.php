<?php

namespace Ayrz;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\scheduler\Task;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\utils\Config;

use Ayrz\LavaupTask;

use Ayrz\Main;

class LavaupCommand extends Command{

    private $plugin;
    public $taskid;

    public function __construct(Main $plugin){
        parent::__construct("lavaup","You start the rising of the lava!");
        $this->plugin = $plugin;
        $this->cfg = new Config($this->plugin->getDataFolder()."Lavaup.yml", Config::YAML);
    }

    public function execute(CommandSender $player, string $label, array $args){
        if($player instanceof Player){
            if(isset($args[0])){
				if($args[0] == "start"){
                    $this->cfg->set("Status", true);
                    $this->cfg->save();
                    $this->plugin->getScheduler()->scheduleRepeatingTask(new LavaupTask($this->plugin,$player), 20 * 1);
                    $player->sendMessage("Lava rising has been started.");

                  }
            }
        }else{
            $player->sendMessage("Please send command game!");
        }
    }//execute

}//class

?>
