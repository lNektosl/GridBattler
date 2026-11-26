<?php

namespace App\Model;

class Action
{
    private string $player;
    private string $commandName;
    private ?string $direction;
    private ?array $target;

    public function __construct(string $player, string $commandName, ?string $direction, ?array $target)
    {
        $this->player = $player;
        $this->commandName = $commandName;
        $this->direction = $direction;
        $this->target = $target;
    }

    public function getPlayer(): string
    {
        return $this->player;
    }

    public function getCommandName(): string
    {
        return $this->commandName;
    }
    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function getTarget(): ?array
    {
        return $this->target;
    }

    public static function constructFromArray(array $command): self
    {
        $target = null;
        if ($command['target'] !== null) {
            $target = [
                'x' => $command['target']['x'],
                'y' => $command['target']['y']
            ];
        }

        return new self(
            $command['player'],
            $command['commandName'],
            $command['direction']??null,
            $target
        );
    }
}
