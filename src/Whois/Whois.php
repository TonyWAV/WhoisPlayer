<?php

namespace Whois;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Whois extends PluginBase{
	
	public function onEnable(){
		$this->essentials = $this->getServer()->getPluginManager()->getPlugin("EssentialsPE");
		if($this->isEssentialsExists() !== false){
			$this->getLogger()->info("§bLoaded with EssentialsPE!");
		}
		$this->getLogger()->info("§aLoaded Successfully!");
	}
	
	public function onCommand(CommandSender $issuer, Command $cmd, $label, array $args){
		switch($cmd->getName()){
			case "whois":
			  if($issuer->hasPermission("whoisplayer.command")){
			  	if(isset($args[0])){
			  		$target = $this->getServer()->getPlayer($args[0]);
			  		if($target !== null){
			  			if(isset($args[1])){
			  				switch($args[1]){
			  					case 2:
			   					  if($this->isEssentialsExists() !== false){
			      					$issuer->sendMessage("§aAfk: §f".($this->getEssentials()->isAfk($target) ? "yes" : "no"));
			      					$issuer->sendMessage("§aGod: §f".($this->getEssentials()->isGod($target) ? "yes" : "no"));
			      					$issuer->sendMessage("§aMuted: §f".($this->getEssentials()->isMuted($target) ? "yes" : "no"));
			      					$issuer->sendMessage("§aPvP: §f".($this->getEssentials()->isPvPEnabled($target) ? "enabled" : "disabled"));
			      					$issuer->sendMessage("§aNickname: §f".$this->getEssentials()->getNick($target));
			  	    				return true;
			  		    		}else{
			  	    				$issuer->sendMessage("§cPage not supported!");
			  					    return true;
			  				    }
			  					break;
		                    }
			  			}else{
			  				 $issuer->sendMessage("§l§3[Whois Player] §b".$target->getName()."§6's information");
			  				 if($this->isEssentialsExists() !== false){
			  				 	  $issuer->sendMessage("§5Type §d/wh <target> 2§5 for next page!");
			  				 }
			  	  		$issuer->sendMessage("§aHealth: §f".$target->getHealth()."§1/§f".$target->getMaxHealth());
			  		  	$issuer->sendMessage("§aLocation: §fx:".$target->x." y:".$target->y." z:".$target->z);
			  		  	$issuer->sendMessage("§aWorld: §f".$target->getLevel()->getName());
			  			  $issuer->sendMessage("§aIP Address: §f".$target->getAddress());
			  			  $issuer->sendMessage("§aGamemode: §f".$this->getGamemodeString($target));
			  			  $issuer->sendMessage("§aOpped: §f".($target->isOp() ? "yes" : "no"));
			  			  $issuer->sendMessage("§aWhitelisted: §f".($target->isWhitelisted() ? "yes" : "no"));
			  			  $issuer->sendMessage("§aFlying: §f".($target->isOnGround() ? "no" : "yes"));
			  			  $issuer->sendMessage("§aNameTag: §f".$target->getNameTag());
			  			  return true;
			  			}
			  		}else{
			  			$issuer->sendMessage("Invalid target!");
			  			return true;
			  		}
			  	}else{
			  		return false;
			  	}
			  }else{
			  	$issuer->sendMessage("§cUnknown Command!");
			  	return true;
			  }
			break;
		}
	}
	
	public function getGamemodeString($player){
		switch($player->getGamemode()){
			case 0:
			  return "Survival";
			case 1:
			  return "Creative";
			case 2:
			  return "Adventure";
			case 3:
			  return "Spectator";
		}
	}
	
	public function getEssentials(){
		return $this->essentials;
	}
	
	public function isEssentialsExists(){
		return $this->getEssentials() !== null;
	}
}
?> 
