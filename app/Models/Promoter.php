<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     schema="Promoter",
 *     title="Promoter",
 *     description="Information about a promoter",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="The ID of the promoter"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the promoter"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         description="Last Name of the promoter"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="The Email of the promoter"
 *     ),
 *      @OA\Property(
 *         property="created_at",
 *         type="date",
 *         description="The Date of creation of the promoter"
 *     ),
 *      @OA\Property(
 *         property="updated_at",
 *         type="date",
 *         description="Was Updated"
 *     ),
 * )
 */

class Promoter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }


}
