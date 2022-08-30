<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartRepository
{
    // ajouter un produit
    public function add(Product $product)
    {
        \Cart::session(auth()->user()->id)
            ->add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
                'attributes' => [],
                'associatedModel' => $product
            ]);

        return $this->count();
    }
    // contenu de notre panier
    public function content()
    {
        return \Cart::session(auth()->user()->id)
        ->getContent();
    }



    public function increase($id)
    {
        \Cart::session(auth()->user()->id)
            ->update($id, [
                'quantity' => +1
            ]);
    }


    public function decrease($id)
    {
        $item = \Cart::session(auth()->user()->id)->get($id);
        if ($item->quantity == 1)
        {
            $this->remove($id);
            return;

        }

        \Cart::session(auth()->user()->id)
            ->update($id, [
                'quantity' => -1
            ]);
    }


    public function remove($id)
    {
        \Cart::session(auth()->user()->id)->remove($id);
    }
     
    public function count()
    {
        return $this->content()
            ->sum('quantity');
    }
    
    public function total()
    {
        return \Cart::session(auth()->user()->id)->getTotal();
    }
    public function jsonOrderItems(): string
    {
        return $this
            ->content()
            ->map(function ($orderItem) {
                return [
                    'name' => $orderItem->name,
                    'quantity' => $orderItem->quantity,
                    'price' => $orderItem->price,
                ];
            })
            ->toJson();
    }
    public function clear()
    {
        \Cart::session(auth()->user()->id)->clear();
    }

}