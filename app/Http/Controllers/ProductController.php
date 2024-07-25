<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show($id): JsonResponse
    {
        $product = DB::selectOne('SELECT * FROM products WHERE id = ?', [$id]);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $stocks = DB::select('
            SELECT ws.id, ws.stock AS count, w.name
            FROM warehouse_stocks ws
            JOIN warehouses w ON ws.warehouse_id = w.id
            WHERE ws.product_id = :product_id
        ', [
            'product_id' => $id,
        ]);

        $characteristics = DB::select('
            SELECT pc.id, pc.name, pc.value
            FROM product_characteristics pc
            WHERE pc.product_id = :product_id
        ', [
            'product_id' => $id,
        ]);

        $response = [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'sku' => $product->sku,
            'name' => $product->name,
            'prices' => [
                'old' => $product->old_price,
                'price' => $product->price,
            ],
            'stocks' => $stocks,
            'description' => $product->description,
            'characteristics' => $characteristics,
            'is_published' => $product->is_published,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ];

        return response()->json($response);
    }

    public function getByFilter(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable|integer',
            'warehouse_id' => 'nullable|integer',
            'price.from' => 'nullable|integer|required_with:price.to',
            'price.to' => 'nullable|integer|required_with:price.from',
            'manufacturer' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $request->all();
        $query = DB::table('products AS p')
            ->select('p.*')
            ->leftJoin('product_characteristics AS pc', 'p.id', '=', 'pc.product_id');

        if (isset($data['category_id'])) {
            $query->where('p.category_id', $data['category_id']);
        }

        if (isset($data['price.from'])) {
            $query->where('p.price', '>=', $data['price']['from']);
        }

        if (isset($data['price.to'])) {
            $query->where('p.price', '<=', $data['price']['to']);
        }

        if (isset($data['manufacturer'])) {
            $query->where('pc.value', $data['manufacturer']);
        }

        if (isset($data['warehouse_id'])) {
            $query->join('warehouse_stocks AS ws', 'p.id', '=', 'ws.product_id')
                ->where('ws.warehouse_id', $data['warehouse_id']);
        }

        $products = $query->paginate(14);
        $formattedProducts = $products->map(function ($product) {
            $stocks = DB::select('
                SELECT ws.id, ws.stock AS count, w.name
                FROM warehouse_stocks ws
                JOIN warehouses w ON ws.warehouse_id = w.id
                WHERE ws.product_id = :product_id
            ', [
                'product_id' => $product->id,
            ]);

            $characteristics = DB::select('
                SELECT pc.id, pc.name, pc.value
                FROM product_characteristics pc
                WHERE pc.product_id = :product_id
            ', [
                'product_id' => $product->id,
            ]);

            return [
                'id' => $product->id,
                'category_id' => $product->category_id,
                'sku' => $product->sku,
                'name' => $product->name,
                'prices' => [
                    'old' => $product->old_price,
                    'price' => $product->price,
                ],
                'stocks' => $stocks,
                'description' => $product->description,
                'characteristics' => $characteristics,
                'is_published' => $product->is_published,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];
        });

        return response()->json([
            'data' => $formattedProducts,
            'total' => $products->total(),
        ]);

    }
}
