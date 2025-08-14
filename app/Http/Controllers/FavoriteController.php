<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favoriteProperties()
            ->with(['images', 'area', 'county', 'type', 'adType', 'category'])
            ->orderBy('favorites.created_at', 'desc')
            ->paginate(10);
        return view('frontend.my_favorite', compact('favorites'));
    }

    public function toggleFavorite(Request $request)
    {
        $property = Property::findOrFail($request->property_id);
        $user = auth()->user();

        if ($user->favoriteProperties()->where('property_id', $property->id)->exists()) {
            $user->favoriteProperties()->detach($property->id);
            return response()->json([
                'status' => 'removed',
                'favorites_count' => $user->favoriteProperties()->count()
            ]);
        } else {
            $user->favoriteProperties()->attach($property->id);
            return response()->json([
                'status' => 'added',
                'favorites_count' => $user->favoriteProperties()->count()
            ]);
        }
    }
}
