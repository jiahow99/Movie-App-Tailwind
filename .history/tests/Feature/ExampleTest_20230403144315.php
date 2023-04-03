<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_mainpage_show_correct_info(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular/' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlaying(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertStatus(200);
    }


    public function test_search_dropdown_works_correctly(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakeSearchDropdown(),
        ]);

        
    }


    private function fakePopularMovies(){
        return Http::response([
            "page" => 1,
            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/ovM06PdF3M8wvKb06i4sjW3xoww.jpg",
                    "genre_ids" => [878, 12, 28],
                    "id" => 76600,
                    "original_language" => "en",
                    "original_title" => "Fake Avatar",
                    "overview" =>
                        "Set more than a decade after the events of the first film, learn the story of the Sully family (Jake, Neytiri, and their kids), the trouble that follows them, the lengths they go to keep each other safe, the battles they fight to stay alive, and the tragedies they endure.",
                    "popularity" => 10224.28,
                    "poster_path" => "/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg",
                    "release_date" => "2022-12-14",
                    "title" => "Avatar: The Way of Water",
                    "video" => false,
                    "vote_average" => 7.7,
                    "vote_count" => 6285,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/wD2kUCX1Bb6oeIb2uz7kbdfLP6k.jpg",
                    "genre_ids" => [27, 53],
                    "id" => 980078,
                    "original_language" => "en",
                    "original_title" => "Winnie the Pooh: Blood and Honey",
                    "overview" =>
                        "Christopher Robin is headed off to college and he has abandoned his old friends, Pooh and Piglet, which then leads to the duo embracing their inner monsters.",
                    "popularity" => 3231.333,
                    "poster_path" => "/fNTtVbqI92abEKAgz2ynurCUne.jpg",
                    "release_date" => "2023-01-27",
                    "title" => "Winnie the Pooh: Blood and Honey",
                    "video" => false,
                    "vote_average" => 5.9,
                    "vote_count" => 281,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/a2tys4sD7xzVaogPntGsT1ypVoT.jpg",
                    "genre_ids" => [53, 35, 80],
                    "id" => 804150,
                    "original_language" => "en",
                    "original_title" => "Cocaine Bear",
                    "overview" =>
                        "Inspired by a true story, an oddball group of cops, criminals, tourists and teens converge in a Georgia forest where a 500-pound black bear goes on a murderous rampage after unintentionally ingesting cocaine.",
                    "popularity" => 2982.867,
                    "poster_path" => "/gOnmaxHo0412UVr1QM5Nekv1xPi.jpg",
                    "release_date" => "2023-02-22",
                    "title" => "Cocaine Bear",
                    "video" => false,
                    "vote_average" => 6.5,
                    "vote_count" => 573,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/i8dshLvq4LE3s0v8PrkDdUyb1ae.jpg",
                    "genre_ids" => [28, 53, 80],
                    "id" => 603692,
                    "original_language" => "en",
                    "original_title" => "John Wick: Chapter 4",
                    "overview" =>
                        "With the price on his head ever increasing, John Wick uncovers a path to defeating The High Table. But before he can earn his freedom, Wick must face off against a new enemy with powerful alliances across the globe and forces that turn old friends into foes.",
                    "popularity" => 2569.508,
                    "poster_path" => "/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg",
                    "release_date" => "2023-03-22",
                    "title" => "John Wick: Chapter 4",
                    "video" => false,
                    "vote_average" => 8.2,
                    "vote_count" => 619,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/m1fgGSLK0WvRpzM1AmZu38m0Tx8.jpg",
                    "genre_ids" => [28],
                    "id" => 842945,
                    "original_language" => "en",
                    "original_title" => "Supercell",
                    "overview" =>
                        "Good-hearted teenager William always lived in hope of following in his late father’s footsteps and becoming a storm chaser. His father’s legacy has now been turned into a storm-chasing tourist business, managed by the greedy and reckless Zane Rogers, who is now using William as the main attraction to lead a group of unsuspecting adventurers deep into the eye of the most dangerous supercell ever seen.",
                    "popularity" => 3000.274,
                    "poster_path" => "/gbGHezV6yrhua0KfAgwrknSOiIY.jpg",
                    "release_date" => "2023-03-17",
                    "title" => "Supercell",
                    "video" => false,
                    "vote_average" => 6.1,
                    "vote_count" => 22,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/eNJhWy7xFzR74SYaSJHqJZuroDm.jpg",
                    "genre_ids" => [28, 878],
                    "id" => 1033219,
                    "original_language" => "en",
                    "original_title" => "Attack on Titan",
                    "overview" =>
                        "As viable water is depleted on Earth, a mission is sent to Saturn\'s moon Titan to retrieve sustainable H2O reserves from its alien inhabitants. But just as the humans acquire the precious resource, they are attacked by Titan rebels, who don\'t trust that the Earthlings will leave in peace.",
                    "popularity" => 1982.341,
                    "poster_path" => "/ay8SLFTMKzQ0i5ewOaGHz2bVuZL.jpg",
                    "release_date" => "2022-09-30",
                    "title" => "Attack on Titan",
                    "video" => false,
                    "vote_average" => 6.2,
                    "vote_count" => 20,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/ouB7hwclG7QI3INoYJHaZL4vOaa.jpg",
                    "genre_ids" => [16, 12, 35, 10751],
                    "id" => 315162,
                    "original_language" => "en",
                    "original_title" => "Puss in Boots: The Last Wish",
                    "overview" =>
                        "Puss in Boots discovers that his passion for adventure has taken its toll: He has burned through eight of his nine lives, leaving him with only one life left. Puss sets out on an epic journey to find the mythical Last Wish and restore his nine lives.",
                    "popularity" => 1913.48,
                    "poster_path" => "/kuf6dutpsT0vSVehic3EZIqkOBt.jpg",
                    "release_date" => "2022-12-07",
                    "title" => "Puss in Boots: The Last Wish",
                    "video" => false,
                    "vote_average" => 8.3,
                    "vote_count" => 4933,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/9H7oVnG4P75bda0y1t7EGDoPnRD.jpg",
                    "genre_ids" => [10752, 28, 12, 53],
                    "id" => 964426,
                    "original_language" => "no",
                    "original_title" => "Gulltransporten",
                    "overview" =>
                        "Fredrik isn’t the bravest of men, but now he is faced with a great responsibility and an enormous task - to get the entire Norwegian gold reserve away from the Nazis during the invasion of Norway.",
                    "popularity" => 1519.193,
                    "poster_path" => "/6E4LopmCMUXcMLIv7o3jw1xQrgJ.jpg",
                    "release_date" => "2022-12-15",
                    "title" => "Gold Run",
                    "video" => false,
                    "vote_average" => 6.3,
                    "vote_count" => 9,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/xZwhwWima3zStcPX1USIMJSR6pd.jpg",
                    "genre_ids" => [28, 18, 27, 878, 53],
                    "id" => 1084225,
                    "original_language" => "en",
                    "original_title" => "The Park",
                    "overview" =>
                        "A dystopian coming-of-age movie focused on three kids who find themselves in an abandoned amusement park, aiming to unite whoever remains. With dangers lurking around every corner, they will do whatever it takes to survive their hellish Neverland.",
                    "popularity" => 1500.568,
                    "poster_path" => "/hR1jdCw0A9czgsbp45TASkjjBhA.jpg",
                    "release_date" => "2023-03-02",
                    "title" => "The Park",
                    "video" => false,
                    "vote_average" => 6.5,
                    "vote_count" => 10,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/2Eewgp7o5AU1xCataDmiIL2nYxd.jpg",
                    "genre_ids" => [18, 36],
                    "id" => 943822,
                    "original_language" => "en",
                    "original_title" => "Prizefighter: The Life of Jem Belcher",
                    "overview" =>
                        "At the turn of the 19th century, Pugilism was the sport of kings and a gifted young boxer fought his way to becoming champion of England.",
                    "popularity" => 1291.016,
                    "poster_path" => "/x3PIk93PTbxT88ohfeb26L1VpZw.jpg",
                    "release_date" => "2022-06-30",
                    "title" => "Prizefighter: The Life of Jem Belcher",
                    "video" => false,
                    "vote_average" => 6.1,
                    "vote_count" => 99,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/u5nY7pY2Y58o7dSM9cy6NclOV8V.jpg",
                    "genre_ids" => [27],
                    "id" => 1023313,
                    "original_language" => "es",
                    "original_title" => "La Exorcista",
                    "overview" =>
                        "Ophelia, a young nun recently arriving in the town of San Ramon, is forced to perform an exorcism on a pregnant woman in danger of dying. Just when she thinks her possession has ended, she discovers that the evil presence hasn\'t disappeared yet. The director of the award-winning Here Comes the Devil and Late Phases adds a new twist to possession movies in one of this year\'s Latin American horror surprises.",
                    "popularity" => 1415.585,
                    "poster_path" => "/d07xtqwq1uriQ1hda6qeu8Skt5m.jpg",
                    "release_date" => "2022-11-02",
                    "title" => "The Exorcist",
                    "video" => false,
                    "vote_average" => 7.3,
                    "vote_count" => 29,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/ql4PnvKYKaMtdx9Ck4fHY2wJphT.jpg",
                    "genre_ids" => [35, 18, 10749],
                    "id" => 32516,
                    "original_language" => "cn",
                    "original_title" => "金瓶梅2 愛的奴隸",
                    "overview" =>
                        "Rich and powerful Simon Qing has been schooled in the ways of sex by his virile father, but is still a virgin. That is, until he meets his first love Violetta who has fun with him all over his father’s estate. Their love does not last, so Simon embarks on a journey. Along the way he meets the comely nun Moon whom Simon deflowers and then marries. He then becomes enamored of Golden Lotus but she is married to dwarf Wu Da-Lang.",
                    "popularity" => 1330.975,
                    "poster_path" => "/A1yymig7S0FTWv9cTtOwdI1cH5V.jpg",
                    "release_date" => "2009-03-04",
                    "title" => "The Forbidden Legend: Sex & Chopsticks 2",
                    "video" => false,
                    "vote_average" => 6,
                    "vote_count" => 63,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/xDMIl84Qo5Tsu62c9DGWhmPI67A.jpg",
                    "genre_ids" => [28, 12, 878],
                    "id" => 505642,
                    "original_language" => "en",
                    "original_title" => "Black Panther: Wakanda Forever",
                    "overview" =>
                        "Queen Ramonda, Shuri, M’Baku, Okoye and the Dora Milaje fight to protect their nation from intervening world powers in the wake of King T’Challa’s death. As the Wakandans strive to embrace their next chapter, the heroes must band together with the help of War Dog Nakia and Everett Ross and forge a new path for the kingdom of Wakanda.",
                    "popularity" => 1178.753,
                    "poster_path" => "/sv1xJUazXeYqALzczSZ3O6nkH75.jpg",
                    "release_date" => "2022-11-09",
                    "title" => "Black Panther: Wakanda Forever",
                    "video" => false,
                    "vote_average" => 7.3,
                    "vote_count" => 4348,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/zM9RGbJBZ3UNpFOabcRqh0iVAYP.jpg",
                    "genre_ids" => [27, 9648, 53],
                    "id" => 631842,
                    "original_language" => "en",
                    "original_title" => "Knock at the Cabin",
                    "overview" =>
                        "While vacationing at a remote cabin, a young girl and her two fathers are taken hostage by four armed strangers who demand that the family make an unthinkable choice to avert the apocalypse. With limited access to the outside world, the family must decide what they believe before all is lost.",
                    "popularity" => 1076.883,
                    "poster_path" => "/dm06L9pxDOL9jNSK4Cb6y139rrG.jpg",
                    "release_date" => "2023-02-01",
                    "title" => "Knock at the Cabin",
                    "video" => false,
                    "vote_average" => 6.4,
                    "vote_count" => 1163,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/sp7MPK2K60LLd7A6zjHKsfgjFil.jpg",
                    "genre_ids" => [27, 53],
                    "id" => 296271,
                    "original_language" => "en",
                    "original_title" => "The Devil Conspiracy",
                    "overview" =>
                        "The hottest biotech company in the world has discovered they can clone history’s most influential people from the dead. Now, they are auctioning clones of Michelangelo, Galileo, Vivaldi, and others for tens of millions of dollars to the world’s ultra-rich. But when they steal the Shroud of Turin and clone the DNA of Jesus Christ, all hell breaks loose.",
                    "popularity" => 1114.108,
                    "poster_path" => "/2lUYbD2C3XSuwqMUbDVDQuz9mqz.jpg",
                    "release_date" => "2023-01-13",
                    "title" => "The Devil Conspiracy",
                    "video" => false,
                    "vote_average" => 6.4,
                    "vote_count" => 72,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/5i6SjyDbDWqyun8klUuCxrlFbyw.jpg",
                    "genre_ids" => [18, 28],
                    "id" => 677179,
                    "original_language" => "en",
                    "original_title" => "Creed III",
                    "overview" =>
                        "After dominating the boxing world, Adonis Creed has been thriving in both his career and family life. When a childhood friend and former boxing prodigy, Damien Anderson, resurfaces after serving a long sentence in prison, he is eager to prove that he deserves his shot in the ring. The face-off between former friends is more than just a fight. To settle the score, Adonis must put his future on the line to battle Damien — a fighter who has nothing to lose.",
                    "popularity" => 1537.879,
                    "poster_path" => "/cvsXj3I9Q2iyyIo95AecSd1tad7.jpg",
                    "release_date" => "2023-03-01",
                    "title" => "Creed III",
                    "video" => false,
                    "vote_average" => 7.2,
                    "vote_count" => 538,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/coWUgAjqwyu2W7YFlb71rlukPKZ.jpg",
                    "genre_ids" => [],
                    "id" => 1076605,
                    "original_language" => "en",
                    "original_title" => "Cazadora",
                    "overview" =>
                        "Psychological thriller where the character\'s strength, submerged in the landscape\'s majesty, leads us through a tense, bleak and chilling path.",
                    "popularity" => 1160.161,
                    "poster_path" => "/p0pvd23j7yA9aJzB6EatoblJ3kO.jpg",
                    "release_date" => "2023-01-19",
                    "title" => "Cazadora",
                    "video" => false,
                    "vote_average" => 5.8,
                    "vote_count" => 6,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/iw0Na1UBHgA5BgifwmQ8vKhlWgA.jpg",
                    "genre_ids" => [16, 12, 10751, 14],
                    "id" => 502356,
                    "original_language" => "en",
                    "original_title" => "The Super Mario Bros. Movie",
                    "overview" =>
                        "While working underground to fix a water main, Brooklyn plumbers—and brothers—Mario and Luigi are transported down a mysterious pipe and wander into a magical new world. But when the brothers are separated, Mario embarks on an epic quest to find Luigi.",
                    "popularity" => 998.194,
                    "poster_path" => "/qNBAXBIQlnOThrVvA6mA2B5ggV6.jpg",
                    "release_date" => "2023-04-05",
                    "title" => "The Super Mario Bros. Movie",
                    "video" => false,
                    "vote_average" => 8.5,
                    "vote_count" => 18,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/qai0MnVwPYCwOPSAnHIHyzBVqnd.jpg",
                    "genre_ids" => [16, 12, 10751, 14],
                    "id" => 776835,
                    "original_language" => "en",
                    "original_title" => "The Magician\'s Elephant",
                    "overview" =>
                        "Peter is searching for his long-lost sister when he crosses paths with a fortune teller in the market square. His one one question is: is his sister still alive? The answer, that he must find a mysterious elephant and the magician who will conjure it, sets Peter off on a journey to complete three seemingly impossible tasks that will change the face of his town forever.",
                    "popularity" => 1069.358,
                    "poster_path" => "/cAoAgzOCxSytYBqqCQulhXNR3LB.jpg",
                    "release_date" => "2023-03-10",
                    "title" => "The Magician\'s Elephant",
                    "video" => false,
                    "vote_average" => 7.5,
                    "vote_count" => 73,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/muw9YsAsSd3DDRme2OEJJoVqun9.jpg",
                    "genre_ids" => [53, 28],
                    "id" => 850871,
                    "original_language" => "es",
                    "original_title" => "Sayen",
                    "overview" =>
                        "Sayen is hunting down the men who murdered her grandmother. Using her training and knowledge of nature, she is able to turn the tables on them, learning of a conspiracy from a corporation that threatens her people\'s ancestral lands.",
                    "popularity" => 982.724,
                    "poster_path" => "/aCy61aU7BMG7SfhkaAaasS0KzUO.jpg",
                    "release_date" => "2023-03-03",
                    "title" => "Sayen",
                    "video" => false,
                    "vote_average" => 6.2,
                    "vote_count" => 66,
                ],
            ],
            "total_pages" => 37706,
            "total_results" => 754113,
        ], 200);
    }

    private function fakeGenres(){
        return Http::response([
            "genres" => [
                ["id" => 28, "name" => "Action"],
                ["id" => 12, "name" => "Adventure"],
                ["id" => 16, "name" => "Animation"],
                ["id" => 35, "name" => "Comedy"],
                ["id" => 80, "name" => "Crime"],
                ["id" => 99, "name" => "Documentary"],
                ["id" => 18, "name" => "Drama"],
                ["id" => 10751, "name" => "Family"],
                ["id" => 14, "name" => "Fantasy"],
                ["id" => 36, "name" => "History"],
                ["id" => 27, "name" => "Horror"],
                ["id" => 10402, "name" => "Music"],
                ["id" => 9648, "name" => "Mystery"],
                ["id" => 10749, "name" => "Romance"],
                ["id" => 878, "name" => "Science Fiction"],
                ["id" => 10770, "name" => "TV Movie"],
                ["id" => 53, "name" => "Thriller"],
                ["id" => 10752, "name" => "War"],
                ["id" => 37, "name" => "Western"],
            ],
        ], 200);
    }
    
    private function fakeNowPlaying(){
        return Http::response([
            "dates" => ["maximum" => "2023-04-07", "minimum" => "2023-02-18"],
            "page" => 1,
            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/gslT8t964rYXyqRcqrxFh77ikyb.jpg",
                    "genre_ids" => [12, 878, 35],
                    "id" => 640146,
                    "original_language" => "en",
                    "original_title" => "Ant-Man and the Wasp: Quantumania",
                    "overview" =>
                        "Super-Hero partners Scott Lang and Hope van Dyne, along with with Hope\'s parents Janet van Dyne and Hank Pym, and Scott\'s daughter Cassie Lang, find themselves exploring the Quantum Realm, interacting with strange new creatures and embarking on an adventure that will push them beyond the limits of what they thought possible.",
                    "popularity" => 676.499,
                    "poster_path" => "/ngl2FKBlU4fhbdsrtdom9LVLBXw.jpg",
                    "release_date" => "2023-02-15",
                    "title" => "Ant-Man and the Wasp: Quantumania",
                    "video" => false,
                    "vote_average" => 6.3,
                    "vote_count" => 1140,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/2rVkDZFLN6DI5PAoraoe9m4IRMN.jpg",
                    "genre_ids" => [12, 14, 35],
                    "id" => 493529,
                    "original_language" => "en",
                    "original_title" => "Dungeons & Dragons: Honor Among Thieves",
                    "overview" =>
                        "A charming thief and a band of unlikely adventurers undertake an epic heist to retrieve a lost relic, but things go dangerously awry when they run afoul of the wrong people.",
                    "popularity" => 702.523,
                    "poster_path" => "/6LuXaihVIoJ5FeSiFb7CZMtU7du.jpg",
                    "release_date" => "2023-03-23",
                    "title" => "Dungeons & Dragons: Honor Among Thieves",
                    "video" => false,
                    "vote_average" => 7.6,
                    "vote_count" => 109,
                ],
            ],
            "total_pages" => 82,
            "total_results" => 1624,
        ], 200);
    }

    private function fakeSearchDropdown(){
        return Http::response([
            "page" => 1,
            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/pYw10zrqfkdm3yD9JTO6vEGQhKy.jpg",
                    "genre_ids" => [12, 14, 10751],
                    "id" => 8844,
                    "original_language" => "en",
                    "original_title" => "Jumanji",
                    "overview" =>
                        "When siblings Judy and Peter discover an enchanted board game that opens the door to a magical world, they unwittingly invite Alan -- an adult who\'s been trapped inside the game for 26 years -- into their living room. Alan\'s only hope for freedom is to finish the game, which proves risky as all three find themselves running from giant rhinoceroses, evil monkeys and other terrifying creatures.",
                    "popularity" => 17.72,
                    "poster_path" => "/vgpXmVaVyUL7GGiDeiK1mKEKzcX.jpg",
                    "release_date" => "1995-12-15",
                    "title" => "Jumanji",
                    "video" => false,
                    "vote_average" => 7.237,
                    "vote_count" => 9511,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/zTxHf9iIOCqRbxvl8W5QYKrsMLq.jpg",
                    "genre_ids" => [12, 35, 14],
                    "id" => 512200,
                    "original_language" => "en",
                    "original_title" => "Jumanji: The Next Level",
                    "overview" =>
                        "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored in order to escape the world’s most dangerous game.",
                    "popularity" => 97.163,
                    "poster_path" => "/jyw8VKYEiM1UDzPB7NsisUgBeJ8.jpg",
                    "release_date" => "2019-12-04",
                    "title" => "Jumanji: The Next Level",
                    "video" => false,
                    "vote_average" => 6.943,
                    "vote_count" => 7578,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/zJDMuXQDraHjtF53wikmyBQIcYe.jpg",
                    "genre_ids" => [12, 28, 35, 14],
                    "id" => 353486,
                    "original_language" => "en",
                    "original_title" => "Jumanji: Welcome to the Jungle",
                    "overview" =>
                        "Four teenagers in detention discover an old video game console with a game they’ve never heard of. When they decide to play, they are immediately sucked into the jungle world of Jumanji in the bodies of their avatars. They’ll have to complete the adventure of their lives filled with fun, thrills and danger or be stuck in the game forever!",
                    "popularity" => 68.225,
                    "poster_path" => "/pSgXKPU5h6U89ipF7HBYajvYt7j.jpg",
                    "release_date" => "2017-12-09",
                    "title" => "Jumanji: Welcome to the Jungle",
                    "video" => false,
                    "vote_average" => 6.824,
                    "vote_count" => 12391,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/mTW5ssHIgGvGzAaOJmyxmuHd62j.jpg",
                    "genre_ids" => [12, 28],
                    "id" => 766208,
                    "original_language" => "en",
                    "original_title" => "Jumanji: Level One",
                    "overview" =>
                        "Set in 1869, two children receive a mysterious game after their father goes missing in the jungles of Africa. They unravel both the secret of their father’s disappearance and the origin of Jumanji. See how it all began.",
                    "popularity" => 19.827,
                    "poster_path" => "/mI7sIBqIsCsTjLvuiVVTfvW3FLU.jpg",
                    "release_date" => "2021-01-20",
                    "title" => "Jumanji: Level One",
                    "video" => false,
                    "vote_average" => 6.107,
                    "vote_count" => 75,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => null,
                    "genre_ids" => [],
                    "id" => 1032450,
                    "original_language" => "en",
                    "original_title" => "Making Jumanji: The Realm of Imagination",
                    "overview" =>
                        "This making-of documentary covers general aspects of the film\'s creation. We see movie clips, shots from the set, and interviews. The latter include remarks from Woodruff, Gillis, director Joe Johnston, producer Scott Kroopf, production designer James Bissell, ILM\'s Mark Miller, and actors Robin Williams, Bonnie Hunt, Kirsten Dunst, David Alan Grier, and Bradley Pierce. We find a basic overview of the story and characters, effects issues, the atmosphere during the shoot, set design and related topics, and how the actors dealt with the various complications.",
                    "popularity" => 1.155,
                    "poster_path" => null,
                    "release_date" => "",
                    "title" => "Making Jumanji: The Realm of Imagination",
                    "video" => true,
                    "vote_average" => 0,
                    "vote_count" => 0,
                ],
                [
                    "adult" => false,
                    "backdrop_path" => "/2DKpjWI0j6eRhF3lPUE4lc7wqP0.jpg",
                    "genre_ids" => [878, 12, 10751],
                    "id" => 6795,
                    "original_language" => "en",
                    "original_title" => "Zathura: A Space Adventure",
                    "overview" =>
                        "After their father is called into work, two young boys, Walter and Danny, are left in the care of their teenage sister, Lisa, and told they must stay inside. Walter and Danny, who anticipate a boring day, are shocked when they begin playing Zathura, a space-themed board game, which they realize has mystical powers when their house is shot into space. With the help of an astronaut, the boys attempt to return home.",
                    "popularity" => 35.583,
                    "poster_path" => "/g0HLEZfqJp5dRxMzkgZwW9puP7N.jpg",
                    "release_date" => "2005-11-06",
                    "title" => "Zathura: A Space Adventure",
                    "video" => false,
                    "vote_average" => 6.375,
                    "vote_count" => 2856,
                ],
            ],
            "total_pages" => 1,
            "total_results" => 6,
        ], 200);
    }

}