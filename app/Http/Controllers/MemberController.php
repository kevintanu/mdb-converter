<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemberController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
        //
  }

  public function index()
  {
    return Member::all();
  }

  public function convert(Request $req)
  {
    ini_set('memory_limit', '256M');

    ini_set('max_execution_time', 300);
    $members = $req->all();
    $filtered = array_filter($members, function ($m) {
      switch (true) {
        case (!isset($m['nik']) || trim($m['nik']) === '' || trim($m['nik']) === 'fffff'):
          return false;
        case (!isset($m['name']) || trim($m['name']) === ''):
          return false;
        case (!isset($m['address']) || trim($m['address']) === ''):
          return false;
        default:
          return true;
      }
    });

    foreach ($filtered as $m) {
      $insertMember = [
        'nik' => $m['nik'],
        'name' => $m['name'],
        'address' => $m['address'],
        'religion' => $m['religion'] === '' ? null : $m['religion'],
        'city' => $m['city'] === '' ? null : $m['city'],
        'kecamatan' => $m['kecamatan'] === '' ? null : $m['kecamatan'],
        'kelurahan' => $m['kelurahan'] === '' ? null : $m['kelurahan'],
        'date_of_birth' => $m['date_of_birth'] === '' ? Carbon::createFromDate(1970, 1, 1) : $m['date_of_birth'],
        'birth_place' => $m['birth_place'] === '' ? null : $m['birth_place'],
        'gender' => 'noinput',
        'shop_id' => $m['shop_id'],
        'scan_idcard' => '/img/idcard/scan_idcard',
        'created_at' => Carbon::createFromDate(2018, 1, 1),
        'updated_at' => Carbon::createFromDate(2018, 6, 1)
      ];


      $insertPhone = array_filter($m['phone_numbers'], function ($p) {
        switch ($p['phone_number']) {
          case ('ff'):
            return false;
          case ('021'):
            return false;
          case ("021-"):
            return false;
          case (""):
            return false;
          default:
            return true;
        }
      });

      $id = DB::table('members')->insertGetId($insertMember);
      foreach ($insertPhone as $p) {
        DB::table('phone_numbers')->insert([
          'phone_number' => $p['phone_number'],
          'type' => $p['type'],
          'member_id' => $id,
          'created_at' => Carbon::createFromDate(2018, 1, 1),
          'updated_at' => Carbon::createFromDate(2018, 6, 1)
        ]);
      }
    }

    return 'Members created successfully';
    // return $insertPhone;
  }
}
