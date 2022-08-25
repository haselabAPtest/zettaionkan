<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

require_once(config('app.phpPATH') . 'function.php');


class ZenhanController extends Controller
{
    public function ques01(Request $request)
    {
        $recv_array = $request->session()->pull('Q_array');
        $recv_count = $request->session()->pull('Q_count');
        $recv_val = $request->input('val');

        if (isset($recv_array, $recv_count)) {
            $ques = $recv_array;
            $count = $recv_count;
            $ans = $request->session()->pull('Q_answer');

            if (isset($recv_val)) {
                $ans[$count - 1] = $recv_val;
            } else {
                //無回答は9999
                $ans[$count - 1] = 999;
            }
        } else {
            $count = 0;                             //現在何問目かカウントする変数
            $numbers = range(0, 107);               //0~106を順に含む配列
            $ans = array();                         //回答者の答えを格納する配列

            $ques = mt_shuffle($numbers);           //0~107の数字をシャッフルして$quesへ格納
        }

        $count++;
        $request->session()->put('Q_array', $ques);
        $request->session()->put('Q_count', $count);
        $request->session()->put('Q_answer', $ans);

        if ($count >= 55) {
            $count = 55;
            echo "<meta http-equiv='refresh' content='0;URL=half'>";
        } else {
            $data = [
                'count' => $count,
                'ques' => $ques,
                'soundNo' => sprintf('%03d', $ques[$count - 1]),
            ];
            if (is_mobile()) {
                return view('piano.sp_ques01', $data);
            } else {
                return view('piano.ques01', $data);
            }
        }
    }

    public function half(Request $request)
    {
        if ($request->session()->has('halfFlag')) {
            return view('piano.half');
        } else if (!($request->session()->has('Q_array'))) {
            return redirect('/');
        } else {
            $recv_array = $request->session()->pull('Q_array');
            $recv_count = $request->session()->pull('Q_count');
            $recv_val = $request->input('val');
            $username = $request->session()->get('username');

            if (isset($recv_array, $recv_count)) {
                $ques = $recv_array;
                $count = $recv_count;
                $ans = $request->session()->pull('Q_answer');

                if (isset($recv_val)) {
                    $ans[$count - 1] = $recv_val;
                } else {
                    //無回答は9999
                    $ans[$count - 1] = 999;
                }
            }

            $data = [
                'name' => $username,
                'ques01' => $ques[0], 'ques02' => $ques[1], 'ques03' => $ques[2], 'ques04' => $ques[3], 'ques05' => $ques[4],
                'ques06' => $ques[5], 'ques07' => $ques[6], 'ques08' => $ques[7], 'ques09' => $ques[8], 'ques10' => $ques[9],
                'ques11' => $ques[10], 'ques12' => $ques[11], 'ques13' => $ques[12], 'ques14' => $ques[13], 'ques15' => $ques[14],
                'ques16' => $ques[15], 'ques17' => $ques[16], 'ques18' => $ques[17], 'ques19' => $ques[18], 'ques20' => $ques[19],
                'ques21' => $ques[20], 'ques22' => $ques[21], 'ques23' => $ques[22], 'ques24' => $ques[23], 'ques25' => $ques[24],
                'ques26' => $ques[25], 'ques27' => $ques[26], 'ques28' => $ques[27], 'ques29' => $ques[28], 'ques30' => $ques[29],
                'ques31' => $ques[30], 'ques32' => $ques[31], 'ques33' => $ques[32], 'ques34' => $ques[33], 'ques35' => $ques[34],
                'ques36' => $ques[35], 'ques37' => $ques[36], 'ques38' => $ques[37], 'ques39' => $ques[38], 'ques40' => $ques[39],
                'ques41' => $ques[40], 'ques42' => $ques[41], 'ques43' => $ques[42], 'ques44' => $ques[43], 'ques45' => $ques[44],
                'ques46' => $ques[45], 'ques47' => $ques[46], 'ques48' => $ques[47], 'ques49' => $ques[48], 'ques50' => $ques[49],
                'ques51' => $ques[50], 'ques52' => $ques[51], 'ques53' => $ques[52], 'ques54' => $ques[53],
                'ans01' => $ans[0], 'ans02' => $ans[1], 'ans03' => $ans[2], 'ans04' => $ans[3], 'ans05' => $ans[4],
                'ans06' => $ans[5], 'ans07' => $ans[6], 'ans08' => $ans[7], 'ans09' => $ans[8], 'ans10' => $ans[9],
                'ans11' => $ans[10], 'ans12' => $ans[11], 'ans13' => $ans[12], 'ans14' => $ans[13], 'ans15' => $ans[14],
                'ans16' => $ans[15], 'ans17' => $ans[16], 'ans18' => $ans[17], 'ans19' => $ans[18], 'ans20' => $ans[19],
                'ans21' => $ans[20], 'ans22' => $ans[21], 'ans23' => $ans[22], 'ans24' => $ans[23], 'ans25' => $ans[24],
                'ans26' => $ans[25], 'ans27' => $ans[26], 'ans28' => $ans[27], 'ans29' => $ans[28], 'ans30' => $ans[29],
                'ans31' => $ans[30], 'ans32' => $ans[31], 'ans33' => $ans[32], 'ans34' => $ans[33], 'ans35' => $ans[34],
                'ans36' => $ans[35], 'ans37' => $ans[36], 'ans38' => $ans[37], 'ans39' => $ans[38], 'ans40' => $ans[39],
                'ans41' => $ans[40], 'ans42' => $ans[41], 'ans43' => $ans[42], 'ans44' => $ans[43], 'ans45' => $ans[44],
                'ans46' => $ans[45], 'ans47' => $ans[46], 'ans48' => $ans[47], 'ans49' => $ans[48], 'ans50' => $ans[49],
                'ans51' => $ans[50], 'ans52' => $ans[51], 'ans53' => $ans[52], 'ans54' => $ans[53],
            ];

            DB::insert(
                'insert into zenhan (namae,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,
                                q21,q22,q23,q24,q25,q26,q27,q28,q29,q30,q31,q32,q33,q34,q35,q36,q37,q38,q39,q40,
                                q41,q42,q43,q44,q45,q46,q47,q48,q49,q50,q51,q52,q53,q54,
                                a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16,a17,a18,a19,a20,
                                a21,a22,a23,a24,a25,a26,a27,a28,a29,a30,a31,a32,a33,a34,a35,a36,a37,a38,a39,a40,
                                a41,a42,a43,a44,a45,a46,a47,a48,a49,a50,a51,a52,a53,a54) 
                        values (:name,:ques01,:ques02,:ques03,:ques04,:ques05,:ques06,:ques07,:ques08,:ques09,:ques10,
                                :ques11,:ques12,:ques13,:ques14,:ques15,:ques16,:ques17,:ques18,:ques19,:ques20,
                                :ques21,:ques22,:ques23,:ques24,:ques25,:ques26,:ques27,:ques28,:ques29,:ques30,
                                :ques31,:ques32,:ques33,:ques34,:ques35,:ques36,:ques37,:ques38,:ques39,:ques40,
                                :ques41,:ques42,:ques43,:ques44,:ques45,:ques46,:ques47,:ques48,:ques49,:ques50,
                                :ques51,:ques52,:ques53,:ques54,
                                :ans01,:ans02,:ans03,:ans04,:ans05,:ans06,:ans07,:ans08,:ans09,:ans10,
                                :ans11,:ans12,:ans13,:ans14,:ans15,:ans16,:ans17,:ans18,:ans19,:ans20,
                                :ans21,:ans22,:ans23,:ans24,:ans25,:ans26,:ans27,:ans28,:ans29,:ans30,
                                :ans31,:ans32,:ans33,:ans34,:ans35,:ans36,:ans37,:ans38,:ans39,:ans40,
                                :ans41,:ans42,:ans43,:ans44,:ans45,:ans46,:ans47,:ans48,:ans49,:ans50,
                                :ans51,:ans52,:ans53,:ans54)',
                $data
            );

            $count = 54;
            $request->session()->put('Q_array', $ques);
            $request->session()->put('Q_count', $count);
            $request->session()->put('Q_answer', $ans);
            $request->session()->forget('enqueteFlag');
            $request->session()->put('halfFlag', 'true');

            return view('piano.half');
        }
    }
}
