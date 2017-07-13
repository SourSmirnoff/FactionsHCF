<?php

namespace FactionsHCF;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\math\Vector3;
use pocketmine\level\level;
use pocketmine\level\Position;

class FactionCommand implements TabExecutor {
	
	public function onTabComplete ($sender, $command, $label, $args) // [CommandSender sender, Command command, String label, String[] args]
	{
		return $Collections->emptyList();
	}
	public function onCommand ($sender, $command, $label, $args) // [CommandSender sender, Command command, String label, String[] args]
	{
		$argument = FactionSubcommand::$HELP;
		if ((count($args) /*from: args.length*/ > 0))
		{
			$argument = FactionSubcommand->getByName($args[0]);
		}
		$argument->dispatch($sender, $this->trim($args));
		return  TRUE ;
	}
	protected function trim ($input) // [String[] input]
	{
		if ((count($input) /*from: input.length*/ < 1))
		{
			return array();
		}
		else
		{
			$output = array();
			for ($i = 1; ($i < count($input) /*from: input.length*/); ++$i) 
			{
				$output[($i - 1)] = $input[$i];
			}
			return $output;
		}
	}
}
