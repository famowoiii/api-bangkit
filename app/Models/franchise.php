<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class franchise extends Model
{
    use HasFactory;

    protected $table ="franchise";
    protected $fillable = ['nama','foto','kontak','harga','paket','deskripsi'];
}
