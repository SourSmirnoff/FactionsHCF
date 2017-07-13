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

class FactionManager {
	
	protected $plugin;	// Revolution
	protected $file;	// File
	protected $factions;	// List<Faction>
	private function __init() { // default class members
		$this->factions = new ArrayList();
	}
	public static function constructor__ () 
	{
		$me = new self();
		$me->__init();
		$me->plugin = Revolution::getInstance();
		$me->file = new File($me->plugin->getDataFolder(), "factions.yml");
		if ($me->file->exists())
		{
			return ;
		}
		try 
		{
			$me->plugin->getResources()->export("factions.yml",  FALSE );
		}
		catch (Exception $exception)
		{
			$exception->printStackTrace();
		}
		return $me;
	}
	public function getByName ($name) // [String name]
	{
		foreach ($this->factions as $faction) 		{
			if ($faction->getName()->equalsIgnoreCase($name))
			{
				return $faction;
			}
		}
		return NULL;
	}
	public function load () 
	{
		$this->factions->clear();
		$config = $YamlConfiguration->loadConfiguration($this->file);
		$object = $config->get("factions");
		if ((($object == NULL) || !($object instanceof MemorySection)))
		{
			print ( "section is null" . "\n");
			return ;
		}
		$section = $object;
		foreach ($section->getKeys( FALSE ) as $key) 		{
			$faction = Faction::constructor__String($section->getConfigurationSection($key));
			$this->factions->add($faction);
		}
		if (($this->getByName("Safezone") == NULL))
		{
			$safezone = Faction::constructor__String("Safezone");
			$safezone->setType(FactionType::$SAFEZONE);
			$this->factions->add($safezone);
		}
	}
	public function save () 
	{
		$config = $YamlConfiguration->loadConfiguration($this->file);
		$config->set("factions", array());
		$sections = new HashMap();
		foreach ($this->factions as $faction) 		{
			$sections->put($faction->getUniqueId()->toString(), $faction->toConfig());
		}
		$config->set("factions", $sections);
		try 
		{
			$config->save($this->file);
		}
		catch (Exception $e)
		{
			$e->printStackTrace();
		}
	}
}
?>
