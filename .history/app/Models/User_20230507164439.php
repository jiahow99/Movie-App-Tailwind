<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'guest_session_id',
        'google_id',
        'github_id',
        'facebook_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Generate new session id if previous one expired.
     *
     */
    public function generate_new_session_id()
    {
        // Get Guest Session Id
        $request = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/authentication/guest_session/new');
            
        // Check if response success, else return error msg
        if($request->getStatusCode() === 200)
        {
            // Set session id
            $session_id = $request->json()['guest_session_id'];
            $this->guest_session_id = $session_id;
            $this->save();
        }else{
            // Return to intended page
            abort( $request->getStatusCode() );
        }
    }


    /**
     * Clear guest session id.
     *
     */
    public function clear_guest_session()
    {
        $this->update(['guest_session_id' => null]); 
    }

}
