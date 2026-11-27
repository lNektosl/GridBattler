<?php

namespace App\Events;

enum Event:string{

    case OnEntityMove = 'OnEntityMove';
    case OnSimulationEnd = 'OnSimulationEnd';
}