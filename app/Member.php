<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // public function shop() {
    //     return $this->belongsTo(Shop::class);
    // }
    
    // public function emails() {
    //     return $this->hasMany(Email::class);
    // }

    // public function phoneNumbers() {
    //     return $this->hasMany(PhoneNumber::class);
    // }

    // public function creditCards() {
    //     return $this->hasMany(CreditCard::class);
    // }

    // protected $with = ['emails', 'phoneNumbers'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
        // 'nik',
        // 'name',
        // 'birth_place',
        // 'date_of_birth',
        // 'gender',
        // 'address',
        // 'kelurahan',
        // 'kecamatan',
        // 'city',
        // 'religion',
        // 'referred_by',
        // 'shop_id',
        // 'scan_idcard'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
        // 'shop_id'
  ];
}
