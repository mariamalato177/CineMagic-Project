<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar próximas exibições
        $upcomingScreenings = Screening::where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')
            ->take(10)
            ->get();

        // Buscar exibições mais vendidas com base nos tickets
        $mostSoldScreenings = Screening::with('movieRef')
            ->join('tickets', 'screenings.id', '=', 'tickets.screening_id')
            ->select('screenings.*', DB::raw('COUNT(tickets.id) as total_tickets_sold'))
            ->groupBy('screenings.id')
            ->orderBy('total_tickets_sold', 'desc')
            ->take(10)
            ->get();

        // Buscar filmes populares da API TMDB
        $response = Http::get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => env('TMDB_API_KEY'), // Adicione sua chave de API TMDB no arquivo .env
            'language' => 'en-US',
            'page' => 1,
        ]);

        // Verificar se a resposta foi bem-sucedida e extrair os filmes
        $popularMovies = $response->successful() ? $response->json()['results'] : [];

        // Passar as três variáveis para a `view`
        return view('home', compact('upcomingScreenings', 'mostSoldScreenings', 'popularMovies'));
    }
}
