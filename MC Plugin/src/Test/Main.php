<?php

namespace ThisCanBeAnything;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

  public function onEnable() : void {

    $this->getLogger()->info(TextFormat::Green . "This plugin is now enabled on " . $this->getServer()->getName());
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  public function onLoad() : void {

    $this->getLogger()->info(TextFormat::Blue . "This plugin is now enabled on " . $this->getServer()->getName());
  }

  public function onDisable() : void {

    $this->getLogger()->info(TextFormat::Red . "This plugin is now disabled on " . $this->getServer()->getName());
  }

  public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {

    $command = strtolower($command->getName());
    $prefix = TextFormat::Blue . "Test" . TextFormat::Green . "Commands" . TextFormat::White . ">>";

    switch($command) {

      case "test":

        if ($sender->hasPermission("test.test") || $sender->hasPermission("test.*")) {

          if (!$args) {

            $sender->sendMessage($prefix . TextFormat::Green . "The test was successful.")
            return true;

          } else {

            return false;
          }
        }

        break;

      case "hello":

        if ($sender->hasPermission("test.hello") || $sender->hasPermission("test.*")) {

          if (!$args) {

            $sender->sendMessage($prefix . TextFormat::Green . "Hello " . $sender . TextFormat::Green . "!")

            return true;

          } elseif ($args[0]) {

            $player = $this->getServer()->getPlayerExact("$args[0]");

            if (!$player) {

              $sender->sendMessage($prefix . TextFormat::Red . "Player " . $args[0] . TextFormat::Red . "could not be found.")
              return true;
            }

            $player->sendMessage($prefix . TextFormat::Blue . "Hello " . $player.getName() . TextFormat::Blue "!");
            return true;

          } else {

            return false;
          }
        }

        break;

      case "creative":

        if ($sender->hasPermission("test.gamemode") || $sender->hasPermission("test.*")) {

          if (!$args) {

            if ($sender->getGamemode() === 1) {

              $sender->sendMessage($prefix . TextFormat::Red . "Your gamemode is already Creative.")
              return true;

            }

            $sender->setGamemode(1);
            $sender->sendMessage($prefix . TextFormat::Green . "Your gamemode has been set to Creative.");
            return true;

          } elseif  ($args[0]) {

            $player = $this->getServer()->getPlayerExact("$args[0]")

            if (!$player) {

              $sender->sendMessage($prefix . TextFormat::Red . "Player " . $args[0] . TextFormat::Red . "could not be found.");
              return true;
            }

            $player->setGamemode(1);
            $player->sendMessage($prefix . TextFormat::Green . $player->getName() . "'s gamemode has been set to Creative.");
            return true;
          } else {

            return false;
          }
        }
        break;

      case "survival":

      if ($sender->hasPermission("test.gamemode") || $sender->hasPermission("test.*")) {

        if (!$args) {

          if ($sender->getGamemode() === 0) {

            $sender->sendMessage($prefix . TextFormat::Red . "Your gamemode is already Survival.");
            return true;
          }

          $sender->setGamemode(0);
          $sender->sendMessage($prefix . TextFormat::Green . "Your gamemode has been set to Survival.");
          return true;
        } elseif ($args[0]) {

          $player = $this->getServer()->getPlayerExact($args[0]);

          if (!$player) {

            $sender->sendMessage($prefix . TextFormat::Red . "Player " . $args[0] . TextFormat::Red . "could not be found.");
            return true;
          }

          $player->setGamemode(0)
          $player->sendMessage($prefix . TextFormat::Green . $player->getName() . "'s gamemode has been set to Survival.");
          return true;
        } else {

          return false;
        }
      }
    }
  }
}

?>
