<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    // public function findForPassport($idnumber){
    //     return $this->where(fn($q)=> $q->where('idnumber', $idnumber)->orWhere('email', $idnumber))->first();
    // }

    // public function getIdNumberAttribute() {
    //     return sprintf("%05d", $this->attributes['id_number']);
    // }
    // public function getTotalUserAttribute(){

    //     return count($this->users);
    // }
    public function getFullNameAttribute($value){
        return ucwords($this->firstname .' '. $this->lastname) ;
    }
    public function getPhotoAttribute($value){
        if($value){
            return asset('images/profile/'. $value);
        }
    }
}
