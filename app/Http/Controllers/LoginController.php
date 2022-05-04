<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use Illuminate\Support\Facades\Redirect;
use App\AllClass\other\dashboardComment\allDashboardComment;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;

class LoginController extends Controller
{
    public function doLogin(Request $request)
    {
     
      $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
      $review_orderbango = $reviewData->orderbango;

       if (!empty(request('mail')))
       {
        $tantousya=tantousya::where('mail',request('mail'))->
                             where('deleteflag','0')
                             ->first();

                  if ($tantousya)
                  {
                      $password=$tantousya->passwd;
                      $accesscode=$tantousya->accesscode;

                      if ($password != request('password'))
                      {
                          if ($accesscode == null)
                          {
                              $tantousya->accesscode= 1;
                              $tantousya->save();
                          }
                          elseif($accesscode == 1)
                          {
                              $tantousya->accesscode= 2;
                              $tantousya->save();
                          }
                          elseif($accesscode == 2)
                          {
                              $tantousya->accesscode= 3;
                              $tantousya->save();
                          }
                          else
                          {
                              $tantousya->accesscode= 1;
                              $tantousya->save();
                          }

                          return redirect()->route("loginPage");
                      }

                      elseif ($tantousya != null && $accesscode != 3 && $password == request('password'))
                      {

                          $bango=$tantousya->bango;

                          $token = '';
                          do
                          {
                              $bytes = uniqid();
                              $token .= str_replace(
                                  ['.','/','='],
                                  '',
                                  base64_encode($bytes)
                              );
                          } while (strlen($token) < 5);

                          //$token= substr($token,5,18);


                          session()->put('login'.$bango, $token);
                          $tantousya->accesscode= $token;
                          $tantousya->save();

                          $deleted_item = 0;
                          $order_by = 1;
                          $order_by_date = 1;
                          $query = allDashboardComment::data($bango, $deleted_item, '', '', '', '', $order_by_date);
                          $dashboardComment = QueryHelper::fetchResult($query);
                          ////cache data clear//
                           \DB::table('misyukko')
                               ->where('datachar03',$bango)
                               ->delete();
                           ////end here/////////

                          if (tantousya::where('bango',$bango)->first()->accesscode == $token)
                          {
                              return view('dashboard',compact('bango','tantousya','dashboardComment'));
                          }
                          else
                          {
                              return redirect()->route("loginPage");
                          }

                      }

                      elseif ($tantousya != null &&  $accesscode == 3 && $password == request('password'))
                      {
                          return redirect()->route("loginPage");
                      }else{
                          return redirect()->route("loginPage");
                      }
                  }

                  else
                  {
                      return redirect()->route("loginPage");
                  }
            }else if(!empty(request('userId')))
            {
                $tantousya=tantousya::where('bango',request('userId'))->first();
                $bango=request('userId');
                $currentToken=session()->get('login'.$bango);
                $tantousya=tantousya::where('bango',$bango)->first();
                
                $deleted_item = 0;
                $order_by = 1;
                $order_by_date = 1;
                $query = allDashboardComment::data($bango, $deleted_item, '', '', '', '', $order_by_date);
                $dashboardComment = QueryHelper::fetchResult($query);
                ////cache data clear//
                \DB::table('misyukko')
                    ->where('datachar03',$bango)
                    ->delete();
                ////end here/////////

                if ($currentToken == $tantousya->accesscode) 
                {
                    return view('dashboard',compact('bango','tantousya','dashboardComment'));
                }
                else
                {
                    return redirect()->route("loginPage");
                }    
            }

            else
            {
                    return redirect()->route("loginPage");
            }
    }

    public function logout(Request $request)
    {
       $bango=request('logOutID');
       $hasBango=session()->get('login'.$bango);

       if ($hasBango != null)
       {
           session()->forget('login'.$bango);
       }

        if ($hasBango != null && tantousya::where('bango',$bango)->first()->accesscode == $hasBango)
        {
            $tantousya=tantousya::find($bango);
            $tantousya->accesscode= null;
            $tantousya->save();

            ////cache data clear//
            \DB::table('misyukko')
                ->where('datachar03',$bango)
                ->delete();
            ////end here/////////
        }


        return redirect()->route("loginPage");

    }
}
