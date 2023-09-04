<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclarationUploads extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'file',
        'type',
        'status',
        'draft_user_id',
        'proofed_user_id',
        'final_proofed_user_id',
        'proofed_at',
        'final_proofed_at',
    ];


    public function draftuser()
    {
        return $this->belongsTo(Users::class, 'draft_user_id');
    }
    public function prooftuser()
    {
        return $this->belongsTo(Users::class, 'proofed_user_id');
    }
    public function finalproofuser()
    {
        return $this->belongsTo(Users::class, 'final_proofed_user_id');
    }
}