<?php
namespace App\Common;

use App\Models\Hotel;

class HotelRepository {
    protected $hotel;
    protected $from;
    protected $to;
    

    function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }

    public function availableRooms($from = null, $to = null)
    {
        if($from) $this->from = $from;
        if($to) $this->to = $to;

        return $this->query()->get();
        
    }

    private function query()
    {
        return $this->hotel->rooms()->whereDoesntHave('reserves', function ($query) {
            return $query->where(function ($q) {
                $q->where(function ($subQuery) {
                    return $subQuery->whereDate('to_date', '>=', $this->from)->whereDate('from_date', '<=', $this->from);
                })->orWhere(function ($subQuery) {
                    return $subQuery->whereDate('from_date', '<=', $this->to)->whereDate('to_date', '>', $this->to);
                });
            })->whereIn('status', ['PROCESSING', 'CONFIRMED', 'CHECKED_IN']);
        });
    }


    public function availableCount($from = null, $to = null)
    {
        if($from) $this->from = $from;
        if($to) $this->to = $to;

        return $this->query()->count();
        
    }



    public function isAvailable($rooms, $from = null, $to = null )
    {
        if($from) $this->from = $from;
        if($to) $this->to = $to;

        return $this->isAvailalableQuery($rooms, $from = null, $to = null )->get();
    }

    public function isAvailalableQuery($rooms, $from = null, $to = null )
    {
        if($from) $this->from = $from;
        if($to) $this->to = $to;

        return $this->query()->whereIn('id', $rooms);
    }

    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    public function to($to)
    {
        $this->to = $to;

        return $this;
    }


}