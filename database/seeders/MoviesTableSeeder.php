<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample genres
        $genres = [
            ['name' => 'Action'],
            ['name' => 'Adventure'],
            ['name' => 'Drama'],
            ['name' => 'Science Fiction'],
            ['name' => 'Comedy'],
            ['name' => 'Thriller'],
            ['name' => 'Romance'],
            ['name' => 'Horror'],
        ];

        // Insert genres
        foreach ($genres as $genre) {
            Genre::firstOrCreate($genre);
        }

        // Sample movies with their genres
        $movies = [
            [
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'duration' => 152,
                'release_date' => Carbon::create(2008, 7, 18),
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg',
                'genres' => ['Action', 'Drama', 'Thriller'],
            ],
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'duration' => 148,
                'release_date' => Carbon::create(2010, 7, 16),
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
                'genres' => ['Action', 'Adventure', 'Science Fiction'],
            ],
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'duration' => 142,
                'release_date' => Carbon::create(1994, 9, 23),
                'poster' => 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_.jpg',
                'genres' => ['Drama'],
            ],
            [
                'title' => 'The Godfather',
                'description' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'duration' => 175,
                'release_date' => Carbon::create(1972, 3, 24),
                'poster' => 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg',
                'genres' => ['Crime', 'Drama'],
            ],
            [
                'title' => 'Parasite',
                'description' => 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.',
                'duration' => 132,
                'release_date' => Carbon::create(2019, 5, 21),
                'poster' => 'https://m.media-amazon.com/images/M/MV5BYWZjMjk3ZTItODQ2ZC00NTY5LWE0ZDYtZTI3MjcwN2Q5NTVkXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_.jpg',
                'genres' => ['Drama', 'Thriller'],
            ],
        ];

        foreach ($movies as $movieData) {
            $genres = $movieData['genres'];
            unset($movieData['genres']);

            $movie = Movie::firstOrCreate(
                ['title' => $movieData['title']],
                $movieData
            );

            // Attach genres
            $genreIds = [];
            foreach ($genres as $genreName) {
                $genre = Genre::where('name', $genreName)->first();
                if ($genre) {
                    $genreIds[] = $genre->id;
                }
            }

            if (! empty($genreIds)) {
                $movie->genre()->sync($genreIds);
            }
        }
    }
}
