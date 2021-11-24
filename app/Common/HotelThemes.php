<?php
namespace App\Common;

use App\Models\Hotel;
use App\Models\Theme;

class HotelThemes{
    protected $hotel;

    function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }


    public function themes()
    {
        $hotelThemes = $this->hotel->themes;

        $initThemes = Theme::all();

        //check if is active
        $activeTheme = $this->hotel->themes()->wherePivot('status', 'ACTIVE')->first();

        if($hotelThemes){
            //check if is installed
            $myThemeIds = $hotelThemes->pluck('id')->toArray();

            $themes = $initThemes->map(function ($theme) use( $myThemeIds, $activeTheme ) {
                if(in_array($theme->id, $myThemeIds)){
                    $theme->is_installed = true;
                }

                if( $activeTheme && $theme->id == $activeTheme->id){
                    $theme->is_active = true;
                }
                return $theme;
            });
            
            // ->sortBy(function ($theme)
            // {
            //     if($theme->is_active == true){
            //         return 1;
            //     }

            //     if($theme->is_installed == true){
            //         return 2;
            //     }

            //     return 3;
            // });
        }else{
            $themes = $initThemes;
        }

        // dd($themes->toArray());

        return $themes;
    }
}