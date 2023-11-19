<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Product;
use App\Models\ItemOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class ItemOrderController extends Controller
{
    public function getOrders()
    {
        $person = Person::where('user_id', '=', Auth::user()->id)->get();
        $item_orders = ItemOrder::where('person_id', '=', $person[0]->id)->get();
        return view('admin.person.OrdersView', ['item_orders' => $item_orders]);
    }

    public function addProduct($id, $quantity)
    {
        $product = Product::find($id);
        $person = Person::where('user_id', '=', Auth::user()->id)->get();

        try {
            $sourceFolder = public_path('storage/products/');
            $destinationFolder = public_path('storage/itemOrders/');
            $imageName = $product->image;

            $extension = File::extension($sourceFolder . $imageName);
            $newImageName = time() . '.' . $extension;

            if (File::exists($sourceFolder . $imageName)) {
                File::copy($sourceFolder . $imageName, $destinationFolder . $newImageName);
            }

            $item_order = ItemOrder::create(
                [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'barcode' => $product->barcode,
                    'image' => $newImageName,
                    'category' => $product->category->name,
                    'brand' => $product->brand->name,
                    'establishment' => $product->establishment->name,
                    'person_id' => $person[0]->id
                ]
            );

            $message = 'producto ' . $item_order->name . ' añadido';
            return redirect()->route('welcome_user')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no se pudo añadir el producto ' . $product->name;
            return redirect()->route('welcome_user')->with('error', $message);
        }
    }

    public function deleteOrder($id)
    {
        try {
            $item_order = ItemOrder::find($id);
            if ($item_order->image && $item_order->image != 'default.svg' && File::exists(public_path('storage/itemOrders/' . $item_order->image))) {
                File::delete(public_path('storage/itemOrders/' . $item_order->image));
            }

            $item_order->delete();
            $message = 'orden quitada';
            return redirect()->route('getOrders')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'la orden no puede ser quitada';
            return redirect()->route('getOrders')->with('error', $message);
        }
    }
}
