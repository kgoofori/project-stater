<?php
namespace App\Common;

use App\Models\Hotel;

class BookingRateCalculator
{
    protected $days;
    protected $rates;
    protected $months = 0;
    protected $weeks = 0;
    protected $amount = 0;
    protected $daily = 0;



    public function __construct(int $days, object $rates)
    {
        $this->days = $days;
        $this->rates = $rates;
    }

    public function total()
    {
        if($this->rates->monthly_rate){
            $this->months =  now()->diffInMonths(now()->addDays($this->days));
        }

        if($this->rates->weekly_rate){
            $this->weeks = now()->addMonths($this->months)->diffInWeeks(now()->addDays($this->days));
        }

        $this->daily = now()->addMonths($this->months)->addWeeks($this->weeks)->diffInDays(now()->addDays($this->days));

        $this->amount = ($this->months * $this->rates->monthly_rate) 
                    + ($this->weeks * $this->rates->weekly_rate) 
                        + ($this->daily * $this->rates->daily_rate);

        return $this->amount;
    }

    public function onlyDaily()
    {
        # code...
    }

    public function onlyWeekly()
    {
        # code...
    }

    public function onlyMonthly()
    {
        # code...
    }
}