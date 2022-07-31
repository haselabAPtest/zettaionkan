<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

require_once(config('app.phpPATH') . 'function.php');

class PianoController extends Controller
{

    public function dbtest01(Request $request)
    {
        $items = DB::select('select * from enquete');
        return view('piano.dbtest01', ['items' => $items]);
    }
    public function dbtest02()
    {
        $items = DB::select('select * from zenhan');
        return view('piano.dbtest02', ['items' => $items]);
    }
    public function dbtest03()
    {
        $items = DB::select('select * from kouhan');
        return view('piano.dbtest03', ['items' => $items]);
    }

    public function mail_test()
    {
        return view('piano.mail_test');
    }

    public function mail_sent(Request $request)
    {
        $mail = $request->input('mail');
        $command = 'python ' . config('app.pythonPATH') . 'mail_test.py 2>&1';
        $answer = [
            'p_C4' => (int) $request->input('0'), 'p_C#4' => (int) $request->input('1'), 'p_D4' => (int) $request->input('2'), 'p_D#4' => (int) $request->input('3'), 'p_E4' => (int) $request->input('4'), 'p_F4' => (int) $request->input('5'),
            'p_F#4' => (int) $request->input('6'), 'p_G4' => (int) $request->input('7'), 'p_G#4' => (int) $request->input('8'), 'p_A4' => (int) $request->input('9'), 'p_A#4' => (int) $request->input('10'), 'p_B4' => (int) $request->input('11'),
            'p_C5' => (int) $request->input('12'), 'p_C#5' => (int) $request->input('13'), 'p_D5' => (int) $request->input('14'), 'p_D#5' => (int) $request->input('15'), 'p_E5' => (int) $request->input('16'), 'p_F5' => (int) $request->input('17'),
            'p_F#5' => (int) $request->input('18'), 'p_G5' => (int) $request->input('19'), 'p_G#5' => (int) $request->input('20'), 'p_A5' => (int) $request->input('21'), 'p_A#5' => (int) $request->input('22'), 'p_B5' => (int) $request->input('23'),
            'p_C6' => (int) $request->input('24'), 'p_C#6' => (int)$request->input('25'), 'p_D6' => (int) $request->input('26'), 'p_D#6' => (int) $request->input('27'), 'p_E6' => (int) $request->input('28'), 'p_F6' => (int) $request->input('29'),
            'p_F#6' => (int) $request->input('30'), 'p_G6' => (int) $request->input('31'), 'p_G#6' => (int) $request->input('32'), 'p_A6' => (int) $request->input('33'), 'p_A#6' => (int) $request->input('34'), 'p_B6' => (int) $request->input('35'),
        ];

        $start_time = microtime(true);

        $json_data = json_encode($mail);
        file_put_contents(config('app.pythonPATH') . 'mail_test.json', $json_data, LOCK_EX);
        $json_answer = json_encode($answer);
        file_put_contents(config('app.pythonPATH') . 'answer_test.json', $json_answer, LOCK_EX);
        exec($command, $output);
        file_put_contents(config('app.pythonPATH') . 'error.txt', $output);
        //unlink('mail_test.json');
        //unlink('answer_test.json');

        $time = microtime(true) - $start_time;
        file_put_contents('D:\xampp\htdocs\piano_demo\app\Python\php_time.txt', $time,);




        return view('piano.mail_sent');
    }

    public function auto_mail()
    {
        return view('piano.auto_mail');
    }
}
