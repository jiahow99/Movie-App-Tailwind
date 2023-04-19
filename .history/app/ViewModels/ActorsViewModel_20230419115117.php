<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popular_actors;
    public $total_pages;
    public $page;


    public function __construct($popular_actors, $total_pages, $page)
    {
        $this->popular_actors = $popular_actors;
        $this->page = $page;
        $this->total_pages = $total_pages;
    }

    
    public function popular_actors(){
        $formatted_popular_actors = array_map(function($actor){
            $actor['profile_path'] = $actor['profile_path']
            ? "https://image.tmdb.org/t/p/w500/" . $actor['profile_path']
            : asset('image/avatar-placeholder.png');
            
            $actor['known_for'] = collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                collect($actor['known_for'])->where('media_type', 'movie')->pluck('name')
            )->implode(', ');

            return $actor;
        }, $this->popular_actors);

        return $formatted_popular_actors;
    }


    public function previous(){
        if($this->page > 1){
            return $this->page - 1;
        }else{
            return null;
        }
    }


    public function next(){ 
        if($this->page < $this->total_pages){
            return $this->page + 1;
        }else{
            return null;
        }
    }
}

