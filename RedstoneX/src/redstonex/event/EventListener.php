<?php

declare(strict_types=1);

namespace redstonex\event;

use pocketmine\block\Block;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use redstonex\block\Redstone;
use redstonex\block\RedstoneTorch;
use redstonex\RedstoneX;

/**
 * Class EventListener
 * @package redstonex\event
 */
class EventListener implements Listener {

    /**
     * @param BlockPlaceEvent $event
     */
    public function onPlace(BlockPlaceEvent $event) {
        switch ($event->getBlock()->getId()) {
            case Block::REDSTONE_TORCH:
                $event->getBlock()->getLevel()->setBlock($event->getBlock()->asVector3(), new RedstoneTorch(0), false, false);
                if($event->getBlock() instanceof Redstone) {
                    RedstoneX::getInstance()->getLogger()->info("Placing block (Redstone Torch) (redstonex block)");
                }
                else {
                    RedstoneX::getInstance()->getLogger()->info("Placing block (Redstone Torch) (pmmp block)");
                }
                $event->setCancelled(true);
                return;
            case Block::REDSTONE_WIRE:
                $event->getBlock()->getLevel()->setBlock($event->getBlock()->asVector3(), new Redstone(RedstoneX::REDSTONE_WIRE, 0, "Redstone Wire", RedstoneX::REDSTONE_ITEM));
                $event->setCancelled(true);
                if($event->getBlock() instanceof RedstoneTorch) {
                    RedstoneX::getInstance()->getLogger()->info("Placing block (Redstone Wire) (redstonex block)");
                }
                else {
                    RedstoneX::getInstance()->getLogger()->info("Placing block (Redstone Wire) (pmmp block)");
                }
                return;
        }
    }
}