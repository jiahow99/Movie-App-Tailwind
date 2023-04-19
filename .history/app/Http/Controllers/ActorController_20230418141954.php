<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\ActorsViewModel;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        try {
            // Get data from API
            $response = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?language=en&page='.$page);

            if($response->getStatusCode() === 200){
                // Convert to JSON
                $data = $response->json();

                $popular_actors = $data['results'];
                $total_pages = intval($data['total_pages']);
    
                $view_model = new ActorsViewModel($popular_actors, $total_pages, intval($page));
    
                return view('actors.index', $view_model);

            }else{
                abort($response->getStatusCode(), $errorMessage);
            }

        } catch (\Throwable $th) {
            abort(500, "External API error.");
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Get data from API
            $response = Http::withToken(config('service.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/' . $id);
            
            if($response->isSuccessful()){
                // Convert to JSON
                $actor = $response->json();

                $view_model = new ActorViewModel($actor);

                return view('actors.show', $view_model);

            }else{
                abort($response->getStatusCode(), $errorMessage);
            }

        } catch (\Throwable $th) {
            abort(500, "External API error.");
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
