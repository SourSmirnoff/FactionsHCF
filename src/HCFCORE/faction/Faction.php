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

class Faction extends Serializable {
	
	protected $name;	// String
	protected $type;	// FactionType
	protected $uniqueId;	// UUID
	public static function constructor__String ($name) // [String name]
	{
		$me = new self();
		parent::constructor__ConfigurationSection(NULL);
		$me->uniqueId = $UUID->randomUUID();
		$me->name = $name;
		$me->type = FactionType::$PLAYER;
		return $me;
	}
	public static function constructor__ConfigurationSection ($section) // [ConfigurationSection section]
	{
		$me = new self();
		parent::constructor__ConfigurationSection(NULL);
		$me->uniqueId = $UUID->fromString($section->getString("uniqueId"));
		$me->name = $section->getString("name");
		$me->type = FactionType->valueOf($section->getString("type"));
		return $me;
	}
	public function toConfig () 
	{
		$section = new MemoryConfiguration();
		$section->set("uniqueId", $this->uniqueId->toString());
		$section->set("name", $this->name);
		$section->set("type", $this->type->name());
		return $section;
	}
	public function displayInformation ($sender) // [CommandSender sender]
	{
		switch ($this->type) {
			case $SAFEZONE:
			case $WARZONE:
			{
				$sender->sendMessage(((((((((((($ChatColor->GOLD + $ChatColor->STRIKETHROUGH->toString()) . "------------") . $ChatColor->GRAY) . "[") . $this->type->getColor()) . $this->name) . $ChatColor->GRAY) . "]") . $ChatColor->GOLD) . $ChatColor->STRIKETHROUGH->toString()) . "------------"));
				$sender->sendMessage(($ChatColor->GRAY . "This is a non player faction."));
				break;
			}
			case $PLAYER:
			{
				$color = $this->type->getColor();
				if ($sender instanceof Player)
				{
					$color = $ChatColor->RED;
				}
				$sender->sendMessage(((((((((((($ChatColor->GOLD + $ChatColor->STRIKETHROUGH->toString()) . "------------") . $ChatColor->GRAY) . "[") . $color) . $this->name) . $ChatColor->GRAY) . "]") . $ChatColor->GOLD) . $ChatColor->STRIKETHROUGH->toString()) . "------------"));
				$sender->sendMessage(($ChatColor->GRAY . "//TODO: Info"));
				break;
			}
			case $CUSTOM:
			{
				$sender->sendMessage(((((((((((($ChatColor->GOLD + $ChatColor->STRIKETHROUGH->toString()) . "------------") . $ChatColor->GRAY) . "[") . $this->type->getColor()) . $this->name) . $ChatColor->GRAY) . "]") . $ChatColor->GOLD) . $ChatColor->STRIKETHROUGH->toString()) . "------------"));
				$sender->sendMessage(($ChatColor->GRAY . "//TODO: Info"));
				break;
			}
			default:
			{
				break;
			}
		}
	}
}
