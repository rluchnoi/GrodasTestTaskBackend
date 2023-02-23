<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrderRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Response;

/**
 * Product Controller
 */
class ProductController extends Controller
{
    /**
     * Construct
     */
    public function __construct(
        private OrderRepository $orderRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response([
            'products' => Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): Response
    {
        $data   = $request->validated();
        $userId = $data['user_id'];
        $order  = $this->orderRepository->getOpenOrderByUserId($userId);

        // if there is no open order for a user - create a new one
        if (!$order) {
            $order = Order::create([
                'user_id' => $userId,
                'status'  => Order::STATUS_OPEN
            ]);
        }

        $product = Product::create([
            'name'     => $data['name'],
            'price'    => $data['price'],
            'order_id' => $order->id
        ]);

        return response([
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response
    {
        return response([
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): Response
    {
        $data = $request->validated();
        $product->update($data);

        return response([
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): Response
    {
        $product->delete();

        return response([
            'success' => true
        ]);
    }
}
