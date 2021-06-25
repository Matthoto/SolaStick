<?php

namespace Matthoto\SolaStick;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{
    private $cooldown = [];
    public function onEnable()
    {
        $this->getLogger()->info("Le plugin a était activé");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function HealStick(PlayerInteractEvent $event){
        $p = $event->getPlayer();
        $i = $event->getItem();
        $a = $event->getAction();
        if($i == Item::BLAZE_ROD){
            $lastPlayerTime = $this->cooldown[$p->getName()] ?? 0;
            $timeNow = time();
            if($a == PlayerInteractEvent::RIGHT_CLICK_AIR || $a == PlayerInteractEvent::RIGHT_CLICK_BLOCK){
                if($timeNow - $lastPlayerTime >=10){
                    if($p->getHealth() <= "20") {
                        $p->setHealth("20");
                        $p->setFood("20");
                        $this->cooldown[$p->getName()] = $timeNow;
                    }else{
                        $p->sendMessage("§4Vous avez déjà toute votre vie !");
                    }
                }else{
                    $p->sendMessage("§4Il vous reste : $timeNow-$lastPlayerTime secondes pour réutiliser le healstick");
                }
            }
        }
    }
    public function ForceStick(PlayerInteractEvent $event){
        $p = $event->getPlayer();
        $i = $event->getItem();
        $a = $event->getAction();
        if($i == Item::END_ROD){
            $lastPlayerTime = $this->cooldown[$p->getName()] ?? 0;
            $timeNow = time();
            if($a == PlayerInteractEvent::RIGHT_CLICK_AIR || $a == PlayerInteractEvent::RIGHT_CLICK_BLOCK){
                if($timeNow - $lastPlayerTime >=30){
                    $effect = new EffectInstance(Effect::getEffect(Effect::STRENGTH));
                    $effect->setAmplifier(1);
                    $effect->setVisible(false);
                    $effect->setDuration(10);
                    $p->addEffect($effect);
                    $p->setFood("20");
                    $p->sendMessage("§4Vous avez bien utilisez le Force Stick");
                    $this->cooldown[$p->getName()] = $timeNow;
                }else{
                    $p->sendMessage("§4Il vous reste : $timeNow-$lastPlayerTime secondes pour réutiliser le forcestick");
                }
            }
        }
    }
    public function SpeedStick(PlayerInteractEvent $event){
        $p = $event->getPlayer();
        $i = $event->getItem();
        $a = $event->getAction();
        if($i == Item::FISHING_ROD){
            $lastPlayerTime = $this->cooldown[$p->getName()] ?? 0;
            $timeNow = time();
            if($a == PlayerInteractEvent::RIGHT_CLICK_AIR || $a == PlayerInteractEvent::RIGHT_CLICK_BLOCK){
                if($timeNow - $lastPlayerTime >=30){
                    $effect = new EffectInstance(Effect::getEffect(Effect::SPEED));
                    $effect->setAmplifier(1);
                    $effect->setVisible(false);
                    $effect->setDuration(10);
                    $p->addEffect($effect);
                    $p->setFood("20");
                    $p->sendMessage("§4Vous avez bien utilisez le Speed Stick");
                    $this->cooldown[$p->getName()] = $timeNow;
                }else{
                    $p->sendMessage("§4Il vous reste : $timeNow-$lastPlayerTime secondes pour réutiliser le speedstick");
                }
            }
        }
    }
}