<?php

namespace App\Models;

use Database\Factories\InformasiFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['judul', 'isi', 'kategori', 'user_id'])]
class Informasi extends Model
{
    /** @use HasFactory<InformasiFactory> */
    use HasFactory;

    protected $table = 'informasi';

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
