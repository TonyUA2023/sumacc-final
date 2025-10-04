<?php
// app/Http/Controllers/HeaderController.php
namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\View\View;

class HeaderController extends Controller
{
    public static function getHeaderData(): array
    {
        $categories = ServiceCategory::with(['services' => function($query) {
            $query->where('is_active', true)
                  ->orderBy('name');
        }])
        ->whereHas('services', function($query) {
            $query->where('is_active', true);
        })
        ->orderBy('display_order')
        ->get();

        return [
            'serviceCategories' => $categories
        ];
    }

    public static function shareHeaderData()
    {
        $headerData = self::getHeaderData();
        view()->share('headerData', $headerData);
    }
}