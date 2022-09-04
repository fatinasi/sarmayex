<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role =='member'){
            return $next($request);
        }

        return response([
            'message'=>'user is not member'
        ]);
    }
}
// eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZGJiMTQ1YjA3ODJiNThiYjVkOGZjYTJlZGFjNTdhNGVlNGEyNzY2MGUzMTgwNmFmNWI3ZTU0M2FmOGIzMjJjN2JhOGM3Y2NmY2QzMmY1ZjQiLCJpYXQiOjE2NDk5MzE3MDEuODczMSwibmJmIjoxNjQ5OTMxNzAxLjg3MzEwOSwiZXhwIjoxNjgxNDY3NzAxLjg0MTQ5NSwic3ViIjoiMSIsInNjb3BlcyI6W119.Sh_VlDdaYq8v2QdEbXpCSjkmP1fkm5Bs3ve9sPvs6yAAgApZOWhUBtPxK1VMu3TidWZkjPnTJ19FhYCN_EXS8I2K7u08BQkGVIWn64UJW0Sy8jwm9KAuTRI3BAGATiOVXMhx8i46CNuhlLkdMCIBwR_B1-eCiT91J6b_WuPbmGwqw-8BpUMOXTAxtvvP2cltI-vFpcuVVgYTaBnpnL-INJnAP-KiLBT2WtYR6vrgJMXnckWqXGk-Xa0F5VciXykUDS3omZOnErQeOk4OLuc4ffoJFJ3kIqjUuvFLm8W7lVL5ZbFZzHHO0eGRiVu2-zwBIegbm050N32mDx6qJ3Ifv85zIA0sS_XsqLTuZ5W0MqUhPXdqOMvjKQPAOlb3vK5OcgbEFWfpSZ4uPOOF5AUMj_wuXbVJame76eQv37UdFyDhvGimdzaXu8xka55KHUIHvh6K2a8DDL8Gn2L4X3J5OcLZt5i6eUCId_OGUibyLcwnVP5ku7bLQbengGD3SfMjtQe_aFGnQlSEmPYZCqdg_E8A1Z7k-dzCCMa6pfT9fJ-efgnJMJ_jDJPkdqIn7t4u9-Uhrhrj9puBXAictTsEcFEfZKJ-sVq80O4540itp_ZeqkAqwHFAd6gsJPYsdx0K3mhgJdp9g1nVLqBlec481lJSyT40-I5vJpGxpVIgmno