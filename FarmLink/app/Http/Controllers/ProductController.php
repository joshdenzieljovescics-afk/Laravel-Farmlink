<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private $baseUrl = 'http://localhost:8801';

    public function getTrendingProducts(): JsonResponse
    {
        try {
            $response = Http::get($this->baseUrl . '/get-trending-products');
            
            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'products' => $data['products'] ?? []
                ], 200);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch trending products',
                'products' => []
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('Error fetching trending products: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Service temporarily unavailable',
                'products' => []
            ], 503);
        }
    }

    public function getNewlyArrivedProducts(): JsonResponse
    {
        try {
            $response = Http::get($this->baseUrl . '/get-newly-arrived-products');
            
            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'products' => $data['products'] ?? []
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch newly arrived products',
                'products' => []
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('Error fetching newly arrived products: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Service temporarily unavailable',
                'products' => []
            ], 503);
        }
    }

    public function getAllProducts(): JsonResponse
    {
        try {
            $response = Http::get($this->baseUrl . '/get-products');
            
            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'products' => $data['products'] ?? []
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products',
                'products' => []
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('Error fetching products: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Service temporarily unavailable',
                'products' => []
            ], 503);
        }
    }

    public function getProduct($id): JsonResponse
    {
        try {
            $response = Http::get($this->baseUrl . '/get-product/' . $id);
            
            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'product' => $data['product'] ?? null
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
                'product' => null
            ], 404);
            
        } catch (\Exception $e) {
            Log::error('Error fetching product: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Service temporarily unavailable',
                'product' => null
            ], 503);
        }
    }

    
    public function testConnection(): JsonResponse
    {
        try {
            $response = Http::timeout(5)->get($this->baseUrl . '/tbl_accounts');
            
            return response()->json([
                'success' => $response->successful(),
                'status' => $response->status(),
                'message' => $response->successful() ? 'Connection successful' : 'Connection failed'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection failed: ' . $e->getMessage()
            ], 503);
        }
    }
}