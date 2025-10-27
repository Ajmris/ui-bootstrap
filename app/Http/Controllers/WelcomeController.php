<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $options = [4, 8, 12, 16];
        
        // Użycie request()->input() dla wszystkich danych z AJAX (w tym filtrów zagnieżdżonych)
        $filters = $request->input('filter', []); 
        
        // Paginacja i strona
        $paginate = $request->input('paginate', 8); 

        $query = Product::query();
        
        // --- LOGIKA FILTROWANIA ---

        // 1. FILTROWANIE KATEGORII
        // Odczytujemy tablicę, domyślnie jest pusta
        $selectedCategories = $filters['categories'] ?? []; 
        
        // Sprawdzamy, czy jest to tablica i ma więcej niż 0 elementów
        if (is_array($selectedCategories) && count($selectedCategories) > 0) {
            // Zamieńmy wartości na int, jeśli to możliwe, aby uniknąć błędów typów w bazie danych
            $categoryIds = array_map('intval', $selectedCategories);
            $query->whereIn('category_id', $categoryIds);
        }
        
        // 2. FILTROWANIE CENY MIN
        if (!empty($filters['price_min'])) {
            $query->where('price', '>=', (float) $filters['price_min']);
        }
        
        // 3. FILTROWANIE CENY MAX
        if (!empty($filters['price_max'])) {
            $query->where('price', '<=', (float) $filters['price_max']);
        }

        $products = $query->paginate($paginate);
        $products->appends(request()->except(['page'])); // appends bez 'page'

        // Jeśli to AJAX
        if ($request->ajax()) {
            return response()->json([
                'data' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'links' => (string) $products->links('pagination::bootstrap-5'),
                ],
            ]);
        }

        return view("welcome", [
            'products' => $products,
            'paginate'=> $paginate,
            'options'=>$options,
            'categories' => ProductCategory::orderBy('name', 'ASC')->get(),
            'defaultImage' => asset('storage/products/no-image.jpg'),
            'isGuest' => Auth::guest()
        ]);
    }
}