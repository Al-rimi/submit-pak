<?php

namespace AlRimi\Submit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'student_name', 'submit_count'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students'; // Explicitly define the table name
}
