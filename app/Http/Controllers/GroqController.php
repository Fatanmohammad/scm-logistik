<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class GroqController extends Controller
{
    public function analyze()
    {
        // Kumpulkan data forecast semua produk
        $products = Product::with('category')->get();
        $summary = [];

        foreach ($products as $product) {
            $movements = StockMovement::where('product_id', $product->id)
                ->where('type', 'out')
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->selectRaw('DATE(created_at) as date, SUM(quantity) as total')
                ->groupBy('date')
                ->pluck('total', 'date')
                ->toArray();

            $dailyUsage = [];
            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->toDateString();
                $dailyUsage[] = $movements[$date] ?? 0;
            }

            $last7 = array_slice($dailyUsage, -7);
            $avgPerDay = count(array_filter($last7)) > 0 ? round(array_sum($last7) / 7, 2) : 0;
            $daysLeft = $avgPerDay > 0 ? floor($product->stock / $avgPerDay) : null;

            $status = match(true) {
                $daysLeft === null  => 'aman',
                $daysLeft <= 7     => 'kritis',
                $daysLeft <= 14    => 'waspada',
                default            => 'aman',
            };

            $summary[] = "- {$product->name} (SKU: {$product->sku}): stok={$product->stock}, rata-rata keluar/hari={$avgPerDay}, estimasi habis=" . ($daysLeft !== null ? "{$daysLeft} hari" : "tidak ada data keluar") . ", status={$status}";
        }

        $dataText = implode("\n", $summary);

        $prompt = <<<EOT
Kamu adalah asisten manajemen logistik dan rantai pasok (SCM). Berikut adalah data prediksi stok produk saat ini:

{$dataText}

Berikan analisis singkat dan rekomendasi tindakan yang harus dilakukan oleh tim logistik. Fokus pada:
1. Produk yang perlu segera direstock (status kritis/waspada)
2. Produk yang aman
3. Saran prioritas tindakan

Gunakan Bahasa Indonesia yang profesional dan ringkas. Jangan gunakan markdown, simbol bintang, atau format apapun. Tulis dalam bentuk teks biasa saja.
EOT;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model'    => env('GROQ_MODEL', 'llama3-8b-8192'),
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 512,
        ]);

        if ($response->failed()) {
            return back()->with('ai_error', 'Gagal menghubungi Groq API. Periksa API key kamu.');
        }

        $result = $response->json('choices.0.message.content');
        return back()->with('ai_result', $result);
    }
}
