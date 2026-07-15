<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.api_key') ?? env('RAJAONGKIR_API_KEY');
        $this->baseUrl = config('services.rajaongkir.base_url') ?? env('RAJAONGKIR_BASE_URL', 'https://api.rajaongkir.com/starter');
    }

    public function getProvinces()
    {
        try {
            $response = Http::withHeaders(['key' => $this->apiKey])
                ->get("{$this->baseUrl}/province");

            if ($response->successful()) {
                return response()->json($response->json()['rajaongkir']['results']);
            }

            return response()->json(['error' => 'Failed to fetch provinces'], 500);
        } catch (\Exception $e) {
            Log::error('RajaOngkir Error: ' . $e->getMessage());
            return response()->json(['error' => 'Connection failed'], 500);
        }
    }

    public function getCities($provinceId = null)
    {
        try {
            $url = "{$this->baseUrl}/city";
            if ($provinceId) {
                $url .= "?province={$provinceId}";
            }

            $response = Http::withHeaders(['key' => $this->apiKey])
                ->get($url);

            if ($response->successful()) {
                return response()->json($response->json()['rajaongkir']['results']);
            }

            return response()->json(['error' => 'Failed to fetch cities'], 500);
        } catch (\Exception $e) {
            Log::error('RajaOngkir Error: ' . $e->getMessage());
            return response()->json(['error' => 'Connection failed'], 500);
        }
    }

    public function calculateShipping(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'weight' => 'required|integer|min:1',
            'courier' => 'required|string|in:jne,jnt,sicepat,pos,tiki',
        ]);

        try {
            $response = Http::asForm()->withHeaders(['key' => $this->apiKey])
                ->post("{$this->baseUrl}/cost", [
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'weight' => $request->weight,
                    'courier' => $request->courier,
                ]);

            if ($response->successful()) {
                $results = $response->json()['rajaongkir']['results'] ?? [];
                return response()->json($results);
            }

            return response()->json(['error' => 'Failed to calculate shipping'], 500);
        } catch (\Exception $e) {
            Log::error('RajaOngkir Error: ' . $e->getMessage());
            return response()->json(['error' => 'Connection failed'], 500);
        }
    }
}