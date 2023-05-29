<?php

namespace App\Models;

use App\Services\Traits\UUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
    protected $table = 'users';

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
        'id'            => 'string',
        'email'         => 'string',
        'password'      => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     *  User detail
     *
     *  @return HasOne
     */
    public function userDetail(): HasOne
    {
        return $this->hasOne(UserDetail::class, 'users_id');
    }

    /**
     *  Applications
     *
     *  @return HasMany
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'users_id');
    }

    /**
     *  Grades
     *
     *  @return HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'users_id');
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

    /**
     *  Email
     *
     *  @param string $value
     *  @return void
     */
    public function setEmailAttribute(string $value): void
    {
        $this->attributes['email'] = trim($value);
    }

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    /**
     *  Get the identifier that will be stored in the subject claim of the JWT.
     *
     *  @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     *  @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     *  Query without admins
     *
     *  @return Builder
     */
    public static function queryWithoutAdmins(): Builder
    {
        return self::query()
            ->with('userDetail')
            ->select('users.*')
            ->where('role', 'user');
    }

    /**
     *  Get user grade
     *
     */
    public function getGradeBySubject(string $subjectName, string $semester): Grade
    {
        $subject = Subject::where('name', $subjectName)->first();
        return Grade::query()
            ->where([
                ['semester', $semester],
                ['subjects_id', $subject->id],
                ['users_id', $this->id]
            ])
            ->first() ?? new Grade();
    }
}
