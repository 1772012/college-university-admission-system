<?php

namespace App\Models;

use App\Services\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationStudyProgram extends Model
{
    use HasFactory, UUID;

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'application_study_programs';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    public $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'string',
        'applications_id'   => 'string',
        'study_programs_id' => 'string',
        'is_accepted'       => 'boolean',
        'is_processed'      => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     *  Application
     *
     *  @return BelongsTo
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'applications_id');
    }

    /**
     *  Study program
     *
     *  @return BelongsTo
     */
    public function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_programs_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    //

    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    //

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    //
}
