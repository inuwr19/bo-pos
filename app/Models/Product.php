<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     required={"name", "category", "price", "qty"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Kopi Gula Aren"),
 *     @OA\Property(property="category", type="string", example="Coffee"),
 *     @OA\Property(property="price", type="number", format="integer", example=25000),
 *     @OA\Property(property="qty", type="integer", example=50),
 *     @OA\Property(property="image", type="string", example="url_ke_gambar_produk"),
 *     @OA\Property(property="description", type="string", example="Kopi dengan gula aren"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name',  'category', 'price', 'qty', 'image', 'description'];
}
