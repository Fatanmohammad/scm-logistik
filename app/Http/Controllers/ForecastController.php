<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Carbon;

class ForecastController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $forecasts = [];

        foreach ($products as $product) {
            // Ambil data 'out' 30 hari terakhir, kelompokkan per hari
            $movements = StockMovement::where('product_id', $product->id)
                ->where('type', 'out')
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->selectRaw('DATE(created_at) as date, SUM(quantity) as total')
                ->groupBy('date')
                ->pluck('total', 'date')
                ->toArray();

            // Isi hari yang tidak ada data dengan 0 (30 hari penuh)
            $dailyUsage = [];
            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->toDateString();
                $dailyUsage[] = $movements[$date] ?? 0;
            }

            // Moving Average 7 hari terakhir
            $last7 = array_slice($dailyUsage, -7);
            $avgPerDay = count(array_filter($last7)) > 0
                ? array_sum($last7) / 7
                : 0;

            // Prediksi hari hingga stok habis
            $daysLeft = $avgPerDay > 0
                ? floor($product->stock / $avgPerDay)
                : null;

            // Status
            $status = match(true) {
                $daysLeft === null       => 'aman',
                $daysLeft <= 7           => 'kritis',
                $daysLeft <= 14          => 'waspada',
                default                  => 'aman',
            };

            $forecasts[] = [
                'product'    => $product,
                'avg_per_day' => round($avgPerDay, 2),
                'days_left'  => $daysLeft,
                'status'     => $status,
            ];
        }

        // Urutkan: kritis dulu, lalu waspada, lalu aman
        usort($forecasts, fn($a, $b) => match($a['status']) {
            'kritis'  => -1,
            'waspada' => $b['status'] === 'kritis' ? 1 : -1,
            default   => 1,
        });

        return view('reports.forecast', compact('forecasts'));
    }
}
