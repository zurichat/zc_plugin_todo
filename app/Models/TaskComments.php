<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComments extends Model
{
	use SoftDeletes;

    use HasFactory;

    public $table = 'components';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


	protected $dates = ['deleted_at'];




	
    /**
     * The attributes that should be fillable.
     *
     * @var array
     */
	public $fillable = [
        'user_id',
        'task_id',
        'body'
    ];


	
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'task_id' => 'integer',
        'body' => 'string'
    ];


	/**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable|integer',
        'task_id' => 'nullable|integer',
        'body' => 'nullable|string|max:1000',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
}
