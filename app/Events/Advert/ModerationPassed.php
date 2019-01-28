<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 27.01.19
 * Time: 22:50
 */

namespace App\Events\Advert;

use App\Entity\Adverts\Advert;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModerationPassed
{
    use Dispatchable, SerializesModels;
    public $advert;

    public function __construct(Advert $advert)
    {
        $this->advert = $advert;
    }
}
