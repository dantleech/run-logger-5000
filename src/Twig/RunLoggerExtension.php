<?php

namespace App\Twig;

use Twig_Extension;
use Twig_Filter;
use App\Service\Statistics;
use App\Entity\Run;

class RunLoggerExtension extends Twig_Extension
{
    /**
     * @var Statistics
     */
    private $statistics;

    public function __construct(Statistics $statistics)
    {
        $this->statistics = $statistics;
    }
    public function getFilters()
    {
        return [
            new Twig_Filter('marathon_time', [ $this, 'marathonTime' ]),
            new Twig_Filter('mph', [ $this, 'mph' ]),
        ];
    }

    public function marathonTime(Run $run)
    {
        return $this->statistics->marathonTime($run->getRoute()->getMeters(), $run->getSeconds());
    }

    public function mph(Run $run)
    {
        return $this->statistics->mph($run->getRoute()->getMeters(), $run->getSeconds());
    }
}
