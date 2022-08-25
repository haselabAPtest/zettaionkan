<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

require_once(config('app.phpPATH') . 'function.php');

class KouhanController extends Controller
{
    public function ques02(Request $request)
    {
        $recv_val = $request->input('val');

        $ques = $request->session()->pull('Q_array');
        $count = $request->session()->pull('Q_count');
        $ans = $request->session()->pull('Q_answer');

        if (isset($recv_val)) {
            $ans[$count - 1] = $recv_val;
        } else {
            //無回答は9999
            $ans[$count - 1] = 999;
        }

        $count++;
        $request->session()->put('Q_array', $ques);
        $request->session()->put('Q_count', $count);
        $request->session()->put('Q_answer', $ans);

        if ($count >= 109) {
            $count = 109;
            echo "<meta http-equiv='refresh' content='0;URL=finish'>";
        } else {
            $data = [
                'count' => $count,
                'ques' => $ques,
                'soundNo' => sprintf('%03d', $ques[$count - 1]),
            ];
            if (is_mobile()) {
                return view('piano.sp_ques02', $data);
            } else {
                return view('piano.ques02', $data);
            }
        }
    }

    public function finish(Request $request)
    {
        if ($request->session()->has('halfFlag')) {
            $recv_array = $request->session()->pull('Q_array');
            $recv_count = $request->session()->pull('Q_count');
            $recv_val = $request->input('val');
            $username = $request->session()->get('username');
            $result = $request->session()->get('result');
            $mail = $request->session()->pull('mail');

            $command = 'python ' . config('app.pythonPATH') . 'send_mail.py 2>&1';

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
                'ques55' => $ques[54], 'ques56' => $ques[55], 'ques57' => $ques[56], 'ques58' => $ques[57], 'ques59' => $ques[58],
                'ques60' => $ques[59], 'ques61' => $ques[60], 'ques62' => $ques[61], 'ques63' => $ques[62], 'ques64' => $ques[63],
                'ques65' => $ques[64], 'ques66' => $ques[65], 'ques67' => $ques[66], 'ques68' => $ques[67], 'ques69' => $ques[68],
                'ques70' => $ques[69], 'ques71' => $ques[70], 'ques72' => $ques[71], 'ques73' => $ques[72], 'ques74' => $ques[73],
                'ques75' => $ques[74], 'ques76' => $ques[75], 'ques77' => $ques[76], 'ques78' => $ques[77], 'ques79' => $ques[78],
                'ques80' => $ques[79], 'ques81' => $ques[80], 'ques82' => $ques[81], 'ques83' => $ques[82], 'ques84' => $ques[83],
                'ques85' => $ques[84], 'ques86' => $ques[85], 'ques87' => $ques[86], 'ques88' => $ques[87], 'ques89' => $ques[88],
                'ques90' => $ques[89], 'ques91' => $ques[90], 'ques92' => $ques[91], 'ques93' => $ques[92], 'ques94' => $ques[93],
                'ques95' => $ques[94], 'ques96' => $ques[95], 'ques97' => $ques[96], 'ques98' => $ques[97], 'ques99' => $ques[98],
                'ques100' => $ques[99], 'ques101' => $ques[100], 'ques102' => $ques[101], 'ques103' => $ques[102], 'ques104' => $ques[103],
                'ques105' => $ques[104], 'ques106' => $ques[105], 'ques107' => $ques[106], 'ques108' => $ques[107],
                'ans55' => $ans[54], 'ans56' => $ans[55], 'ans57' => $ans[56], 'ans58' => $ans[57], 'ans59' => $ans[58],
                'ans60' => $ans[59], 'ans61' => $ans[60], 'ans62' => $ans[61], 'ans63' => $ans[62], 'ans64' => $ans[63],
                'ans65' => $ans[64], 'ans66' => $ans[65], 'ans67' => $ans[66], 'ans68' => $ans[67], 'ans69' => $ans[68],
                'ans70' => $ans[69], 'ans71' => $ans[70], 'ans72' => $ans[71], 'ans73' => $ans[72], 'ans74' => $ans[73],
                'ans75' => $ans[74], 'ans76' => $ans[75], 'ans77' => $ans[76], 'ans78' => $ans[77], 'ans79' => $ans[78],
                'ans80' => $ans[79], 'ans81' => $ans[80], 'ans82' => $ans[81], 'ans83' => $ans[82], 'ans84' => $ans[83],
                'ans85' => $ans[84], 'ans86' => $ans[85], 'ans87' => $ans[86], 'ans88' => $ans[87], 'ans89' => $ans[88],
                'ans90' => $ans[89], 'ans91' => $ans[90], 'ans92' => $ans[91], 'ans93' => $ans[92], 'ans94' => $ans[93],
                'ans95' => $ans[94], 'ans96' => $ans[95], 'ans97' => $ans[96], 'ans98' => $ans[97], 'ans99' => $ans[98],
                'ans100' => $ans[99], 'ans101' => $ans[100], 'ans102' => $ans[101], 'ans103' => $ans[102], 'ans104' => $ans[103],
                'ans105' => $ans[104], 'ans106' => $ans[105], 'ans107' => $ans[106], 'ans108' => $ans[107],
            ];

            DB::insert(
                'insert into kouhan (namae,q55,q56,q57,q58,q59,q60,q61,q62,q63,q64,q65,q66,q67,q68,q69,q70,q71,q72,q73,q74,
                                    q75,q76,q77,q78,q79,q80,q81,q82,q83,q84,q85,q86,q87,q88,q89,q90,q91,q92,q93,q94,
                                    q95,q96,q97,q98,q99,q100,q101,q102,q103,q104,q105,q106,q107,q108,
                                    a55,a56,a57,a58,a59,a60,a61,a62,a63,a64,a65,a66,a67,a68,a69,a70,a71,a72,a73,a74,
                                    a75,a76,a77,a78,a79,a80,a81,a82,a83,a84,a85,a86,a87,a88,a89,a90,a91,a92,a93,a94,
                                    a95,a96,a97,a98,a99,a100,a101,a102,a103,a104,a105,a106,a107,a108) 
                            values (:name,:ques55,:ques56,:ques57,:ques58,:ques59,:ques60,:ques61,:ques62,:ques63,:ques64,
                                    :ques65,:ques66,:ques67,:ques68,:ques69,:ques70,:ques71,:ques72,:ques73,:ques74,
                                    :ques75,:ques76,:ques77,:ques78,:ques79,:ques80,:ques81,:ques82,:ques83,:ques84,
                                    :ques85,:ques86,:ques87,:ques88,:ques89,:ques90,:ques91,:ques92,:ques93,:ques94,
                                    :ques95,:ques96,:ques97,:ques98,:ques99,:ques100,:ques101,:ques102,:ques103,:ques104,
                                    :ques105,:ques106,:ques107,:ques108,
                                    :ans55,:ans56,:ans57,:ans58,:ans59,:ans60,:ans61,:ans62,:ans63,:ans64,
                                    :ans65,:ans66,:ans67,:ans68,:ans69,:ans70,:ans71,:ans72,:ans73,:ans74,
                                    :ans75,:ans76,:ans77,:ans78,:ans79,:ans80,:ans81,:ans82,:ans83,:ans84,
                                    :ans85,:ans86,:ans87,:ans88,:ans89,:ans90,:ans91,:ans92,:ans93,:ans94,
                                    :ans95,:ans96,:ans97,:ans98,:ans99,:ans100,:ans101,:ans102,:ans103,:ans104,
                                    :ans105,:ans106,:ans107,:ans108)',
                $data
            );

            //ここから
            //問題と回答を紐づけ
            $mail_data = [
                $ques[0] => $ans[0], $ques[1] => $ans[1], $ques[2] => $ans[2], $ques[3] => $ans[3], $ques[4] => $ans[4], $ques[5] => $ans[5], $ques[6] => $ans[6], $ques[7] => $ans[7], $ques[8] => $ans[8], $ques[9] => $ans[9],
                $ques[10] => $ans[10], $ques[11] => $ans[11], $ques[12] => $ans[12], $ques[13] => $ans[13], $ques[14] => $ans[14], $ques[15] => $ans[15], $ques[16] => $ans[16], $ques[17] => $ans[17], $ques[18] => $ans[18], $ques[19] => $ans[19],
                $ques[20] => $ans[20], $ques[21] => $ans[21], $ques[22] => $ans[22], $ques[23] => $ans[23], $ques[24] => $ans[24], $ques[25] => $ans[25], $ques[26] => $ans[26], $ques[27] => $ans[27], $ques[28] => $ans[28], $ques[29] => $ans[29],
                $ques[30] => $ans[30], $ques[31] => $ans[31], $ques[32] => $ans[32], $ques[33] => $ans[33], $ques[34] => $ans[34], $ques[35] => $ans[35], $ques[36] => $ans[36], $ques[37] => $ans[37], $ques[38] => $ans[38], $ques[39] => $ans[39],
                $ques[40] => $ans[40], $ques[41] => $ans[41], $ques[42] => $ans[42], $ques[43] => $ans[43], $ques[44] => $ans[44], $ques[45] => $ans[45], $ques[46] => $ans[46], $ques[47] => $ans[47], $ques[48] => $ans[48], $ques[49] => $ans[49],
                $ques[50] => $ans[50], $ques[51] => $ans[51], $ques[52] => $ans[52], $ques[53] => $ans[53], $ques[54] => $ans[54], $ques[55] => $ans[55], $ques[56] => $ans[56], $ques[57] => $ans[57], $ques[58] => $ans[58], $ques[59] => $ans[59],
                $ques[60] => $ans[60], $ques[61] => $ans[61], $ques[62] => $ans[62], $ques[63] => $ans[63], $ques[64] => $ans[64], $ques[65] => $ans[65], $ques[66] => $ans[66], $ques[67] => $ans[67], $ques[68] => $ans[68], $ques[69] => $ans[69],
                $ques[70] => $ans[70], $ques[71] => $ans[71], $ques[72] => $ans[72], $ques[73] => $ans[73], $ques[74] => $ans[74], $ques[75] => $ans[75], $ques[76] => $ans[76], $ques[77] => $ans[77], $ques[78] => $ans[78], $ques[79] => $ans[79],
                $ques[80] => $ans[80], $ques[81] => $ans[81], $ques[82] => $ans[82], $ques[83] => $ans[83], $ques[84] => $ans[84], $ques[85] => $ans[85], $ques[86] => $ans[86], $ques[87] => $ans[87], $ques[88] => $ans[88], $ques[89] => $ans[89],
                $ques[90] => $ans[90], $ques[91] => $ans[91], $ques[92] => $ans[92], $ques[93] => $ans[93], $ques[94] => $ans[94], $ques[95] => $ans[95], $ques[96] => $ans[96], $ques[97] => $ans[97], $ques[98] => $ans[98], $ques[99] => $ans[99],
                $ques[100] => $ans[100], $ques[101] => $ans[101], $ques[102] => $ans[102], $ques[103] => $ans[103], $ques[104] => $ans[104], $ques[105] => $ans[105], $ques[106] => $ans[106], $ques[107] => $ans[107],
            ];

            //紐づけしたデータをキーでソート
            //$mail_data[0]→ピアノC4の回答、$mail_data[1]→ピアノD4の回答、$mail_data[2]→ピアノE4の回答・・・のようにソートされる
            ksort($mail_data);

            //ソートしたデータをデータベース格納用の連想配列にする
            //それぞれp_C4→ピアノ音C4、p_Cs4→ピアノ音C#4(カラム名に#が使えないためCs)、g_C4→ギター音C4、s_C4→純音C4をあらわす
            $sorted_data = [
                'name' => $username, 'mail' => $mail,
                'p_C4' => $mail_data[0], 'p_Cs4' => $mail_data[1], 'p_D4' => $mail_data[2], 'p_Ds4' => $mail_data[3], 'p_E4' => $mail_data[4], 'p_F4' => $mail_data[5], 'p_Fs4' => $mail_data[6], 'p_G4' => $mail_data[7], 'p_Gs4' => $mail_data[8], 'p_A4' => $mail_data[9], 'p_As4' => $mail_data[10], 'p_B4' => $mail_data[11],
                'p_C5' => $mail_data[12], 'p_Cs5' => $mail_data[13], 'p_D5' => $mail_data[14], 'p_Ds5' => $mail_data[15], 'p_E5' => $mail_data[16], 'p_F5' => $mail_data[17], 'p_Fs5' => $mail_data[18], 'p_G5' => $mail_data[19], 'p_Gs5' => $mail_data[20], 'p_A5' => $mail_data[21], 'p_As5' => $mail_data[22], 'p_B5' => $mail_data[23],
                'p_C6' => $mail_data[24], 'p_Cs6' => $mail_data[25], 'p_D6' => $mail_data[26], 'p_Ds6' => $mail_data[27], 'p_E6' => $mail_data[28], 'p_F6' => $mail_data[29], 'p_Fs6' => $mail_data[30], 'p_G6' => $mail_data[31], 'p_Gs6' => $mail_data[32], 'p_A6' => $mail_data[33], 'p_As6' => $mail_data[34], 'p_B6' => $mail_data[35],
                'g_C4' => $mail_data[36], 'g_Cs4' => $mail_data[37], 'g_D4' => $mail_data[38], 'g_Ds4' => $mail_data[39], 'g_E4' => $mail_data[40], 'g_F4' => $mail_data[41], 'g_Fs4' => $mail_data[42], 'g_G4' => $mail_data[43], 'g_Gs4' => $mail_data[44], 'g_A4' => $mail_data[45], 'g_As4' => $mail_data[46], 'g_B4' => $mail_data[47],
                'g_C5' => $mail_data[48], 'g_Cs5' => $mail_data[49], 'g_D5' => $mail_data[50], 'g_Ds5' => $mail_data[51], 'g_E5' => $mail_data[52], 'g_F5' => $mail_data[53], 'g_Fs5' => $mail_data[54], 'g_G5' => $mail_data[55], 'g_Gs5' => $mail_data[56], 'g_A5' => $mail_data[57], 'g_As5' => $mail_data[58], 'g_B5' => $mail_data[59],
                'g_C6' => $mail_data[60], 'g_Cs6' => $mail_data[61], 'g_D6' => $mail_data[62], 'g_Ds6' => $mail_data[63], 'g_E6' => $mail_data[64], 'g_F6' => $mail_data[65], 'g_Fs6' => $mail_data[66], 'g_G6' => $mail_data[67], 'g_Gs6' => $mail_data[68], 'g_A6' => $mail_data[69], 'g_As6' => $mail_data[70], 'g_B6' => $mail_data[71],
                's_C4' => $mail_data[72], 's_Cs4' => $mail_data[73], 's_D4' => $mail_data[74], 's_Ds4' => $mail_data[75], 's_E4' => $mail_data[76], 's_F4' => $mail_data[77], 's_Fs4' => $mail_data[78], 's_G4' => $mail_data[79], 's_Gs4' => $mail_data[80], 's_A4' => $mail_data[81], 's_As4' => $mail_data[82], 's_B4' => $mail_data[83],
                's_C5' => $mail_data[84], 's_Cs5' => $mail_data[85], 's_D5' => $mail_data[86], 's_Ds5' => $mail_data[87], 's_E5' => $mail_data[88], 's_F5' => $mail_data[89], 's_Fs5' => $mail_data[90], 's_G5' => $mail_data[91], 's_Gs5' => $mail_data[92], 's_A5' => $mail_data[93], 's_As5' => $mail_data[94], 's_B5' => $mail_data[95],
                's_C6' => $mail_data[96], 's_Cs6' => $mail_data[97], 's_D6' => $mail_data[98], 's_Ds6' => $mail_data[99], 's_E6' => $mail_data[100], 's_F6' => $mail_data[101], 's_Fs6' => $mail_data[102], 's_G6' => $mail_data[103], 's_Gs6' => $mail_data[104], 's_A6' => $mail_data[105], 's_As6' => $mail_data[106], 's_B6' => $mail_data[107],
            ];

            //メール送信用テーブルにインサート
            DB::insert(
                'insert into send_mail (namae,mail,
                                        p_C4,p_Cs4,p_D4,p_Ds4,p_E4,p_F4,p_Fs4,p_G4,p_Gs4,p_A4,p_As4,p_B4,
                                        p_C5,p_Cs5,p_D5,p_Ds5,p_E5,p_F5,p_Fs5,p_G5,p_Gs5,p_A5,p_As5,p_B5,
                                        p_C6,p_Cs6,p_D6,p_Ds6,p_E6,p_F6,p_Fs6,p_G6,p_Gs6,p_A6,p_As6,p_B6,
                                        g_C4,g_Cs4,g_D4,g_Ds4,g_E4,g_F4,g_Fs4,g_G4,g_Gs4,g_A4,g_As4,g_B4,
                                        g_C5,g_Cs5,g_D5,g_Ds5,g_E5,g_F5,g_Fs5,g_G5,g_Gs5,g_A5,g_As5,g_B5,
                                        g_C6,g_Cs6,g_D6,g_Ds6,g_E6,g_F6,g_Fs6,g_G6,g_Gs6,g_A6,g_As6,g_B6,
                                        s_C4,s_Cs4,s_D4,s_Ds4,s_E4,s_F4,s_Fs4,s_G4,s_Gs4,s_A4,s_As4,s_B4,
                                        s_C5,s_Cs5,s_D5,s_Ds5,s_E5,s_F5,s_Fs5,s_G5,s_Gs5,s_A5,s_As5,s_B5,
                                        s_C6,s_Cs6,s_D6,s_Ds6,s_E6,s_F6,s_Fs6,s_G6,s_Gs6,s_A6,s_As6,s_B6) 
                            values (:name,:mail,
                                    :p_C4,:p_Cs4,:p_D4,:p_Ds4,:p_E4,:p_F4,:p_Fs4,:p_G4,:p_Gs4,:p_A4,:p_As4,:p_B4,
                                    :p_C5,:p_Cs5,:p_D5,:p_Ds5,:p_E5,:p_F5,:p_Fs5,:p_G5,:p_Gs5,:p_A5,:p_As5,:p_B5,
                                    :p_C6,:p_Cs6,:p_D6,:p_Ds6,:p_E6,:p_F6,:p_Fs6,:p_G6,:p_Gs6,:p_A6,:p_As6,:p_B6,
                                    :g_C4,:g_Cs4,:g_D4,:g_Ds4,:g_E4,:g_F4,:g_Fs4,:g_G4,:g_Gs4,:g_A4,:g_As4,:g_B4,
                                    :g_C5,:g_Cs5,:g_D5,:g_Ds5,:g_E5,:g_F5,:g_Fs5,:g_G5,:g_Gs5,:g_A5,:g_As5,:g_B5,
                                    :g_C6,:g_Cs6,:g_D6,:g_Ds6,:g_E6,:g_F6,:g_Fs6,:g_G6,:g_Gs6,:g_A6,:g_As6,:g_B6,
                                    :s_C4,:s_Cs4,:s_D4,:s_Ds4,:s_E4,:s_F4,:s_Fs4,:s_G4,:s_Gs4,:s_A4,:s_As4,:s_B4,
                                    :s_C5,:s_Cs5,:s_D5,:s_Ds5,:s_E5,:s_F5,:s_Fs5,:s_G5,:s_Gs5,:s_A5,:s_As5,:s_B5,
                                    :s_C6,:s_Cs6,:s_D6,:s_Ds6,:s_E6,:s_F6,:s_Fs6,:s_G6,:s_Gs6,:s_A6,:s_As6,:s_B6)',
                $sorted_data
            );

            //ここまで
            $request->session()->forget('halfFlag');
            $request->session()->flush();
            if ($result == 'はい' && $mail != '') {
                exec($command, $output);
            }

            return view('piano.finish');
        } else {
            return view('piano.finish');
        }
    }


    //テスト用
    public function send_db()
    {
        $sorted_data = [
            'name' => 'ななし',
            'p_C4' => 0, 'p_Cs4' => 1, 'p_D4' => 2, 'p_Ds4' => 3, 'p_E4' => 4, 'p_F4' => 5, 'p_Fs4' => 6, 'p_G4' => 7, 'p_Gs4' => 8, 'p_A4' => 9, 'p_As4' => 10, 'p_B4' => 11,
            'p_C5' => 0, 'p_Cs5' => 1, 'p_D5' => 2, 'p_Ds5' => 3, 'p_E5' => 4, 'p_F5' => 5, 'p_Fs5' => 6, 'p_G5' => 7, 'p_Gs5' => 8, 'p_A5' => 9, 'p_As5' => 10, 'p_B5' => 11,
            'p_C6' => 0, 'p_Cs6' => 1, 'p_D6' => 2, 'p_Ds6' => 3, 'p_E6' => 4, 'p_F6' => 5, 'p_Fs6' => 6, 'p_G6' => 7, 'p_Gs6' => 8, 'p_A6' => 9, 'p_As6' => 10, 'p_B6' => 11,
            /*
            'p_C4' => 0, 'p_Cs4' => 1, 'p_D4' => 2, 'p_Ds4' => 3, 'p_E4' => 4, 'p_F4' => 5, 'p_Fs4' => 6, 'p_G4' => 7, 'p_Gs4' => 8, 'p_A4' => 9, 'p_As4' => 10, 'p_B4' => 11,
            'g_C4' => 0, 'g_Cs4' => 1, 'g_D4' => 2, 'g_Ds4' => 3, 'g_E4' => 4, 'g_F4' => 5, 'g_Fs4' => 6, 'g_G4' => 7, 'g_Gs4' => 8, 'g_A4' => 9, 'g_As4' => 10, 'g_B4' => 11,
            'g_C4' => 0, 'g_Cs4' => 1, 'g_D4' => 2, 'g_Ds4' => 3, 'g_E4' => 4, 'g_F4' => 5, 'g_Fs4' => 6, 'g_G4' => 7, 'g_Gs4' => 8, 'g_A4' => 9, 'g_As4' => 10, 'g_B4' => 11,
            'g_C4' => 0, 'g_Cs4' => 1, 'g_D4' => 2, 'g_Ds4' => 3, 'g_E4' => 4, 'g_F4' => 5, 'g_Fs4' => 6, 'g_G4' => 7, 'g_Gs4' => 8, 'g_A4' => 9, 'g_As4' => 10, 'g_B4' => 11,
            's_C4' => 0, 's_Cs4' => 1, 's_D4' => 2, 's_Ds4' => 3, 's_E4' => 4, 's_F4' => 5, 's_Fs4' => 6, 's_G4' => 7, 's_Gs4' => 8, 's_A4' => 9, 's_As4' => 10, 's_B4' => 11,
            's_C4' => 0, 's_Cs4' => 1, 's_D4' => 2, 's_Ds4' => 3, 's_E4' => 4, 's_F4' => 5, 's_Fs4' => 6, 's_G4' => 7, 's_Gs4' => 8, 's_A4' => 9, 's_As4' => 10, 's_B4' => 11,
            's_C4' => 0, 's_Cs4' => 1, 's_D4' => 2, 's_Ds4' => 3, 's_E4' => 4, 's_F4' => 5, 's_Fs4' => 6, 's_G4' => 7, 's_Gs4' => 8, 's_A4' => 9, 's_As4' => 10, 's_B4' => 11,
            */
        ];

        DB::insert(
            'insert into send_db (namae,
                                p_C4,p_Cs4,p_D4,p_Ds4,p_E4,p_F4,p_Fs4,p_G4,p_Gs4,p_A4,p_As4,p_B4,
                                p_C5,p_Cs5,p_D5,p_Ds5,p_E5,p_F5,p_Fs5,p_G5,p_Gs5,p_A5,p_As5,p_B5,
                                p_C6,p_Cs6,p_D6,p_Ds6,p_E6,p_F6,p_Fs6,p_G6,p_Gs6,p_A6,p_As6,p_B6) 
                        values (:name,
                                :p_C4,:p_Cs4,:p_D4,:p_Ds4,:p_E4,:p_F4,:p_Fs4,:p_G4,:p_Gs4,:p_A4,:p_As4,:p_B4,
                                :p_C5,:p_Cs5,:p_D5,:p_Ds5,:p_E5,:p_F5,:p_Fs5,:p_G5,:p_Gs5,:p_A5,:p_As5,:p_B5,
                                :p_C6,:p_Cs6,:p_D6,:p_Ds6,:p_E6,:p_F6,:p_Fs6,:p_G6,:p_Gs6,:p_A6,:p_As6,:p_B6)',
            $sorted_data
        );
    }
}
