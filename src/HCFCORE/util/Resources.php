

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

	protected $plugin;	// Revolution
	public static function constructor__Revolution ($plugin) // [Revolution plugin]
	{
		$me = new self();
		$me->plugin = $plugin;
		return $me;
	}
	public function export ($fileName, $abortIfNotInJar) // [String fileName, boolean abortIfNotInJar]
	{
		$file = new File($this->plugin->getDataFolder(), $fileName);
		try 
		{
			if (!$file->exists())
			{
				if (($this->plugin->getResource($fileName) != NULL))
				{
					$this->plugin->saveResource($fileName,  FALSE );
					return  TRUE ;
				}
				else
					if (!$abortIfNotInJar)
					{
						$file->createNewFile();
						return  TRUE ;
					}
			}
		}
		catch (Exception $exception)
		{
			$exception->printStackTrace();
		}
		return  FALSE ;
	}
}
