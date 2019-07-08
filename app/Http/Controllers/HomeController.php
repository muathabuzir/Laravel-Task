<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SavedResults;
use App\Services\Google;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Google $google) {
        $result = array();

        if ($request->has('search'))
            $result = $this->getResult($request, $google);

        return view('home', ['result' => $result]);
    }

    private function getResult(Request $request, Google $google) {

        $this->validate($request, [
            'search' => 'required'
        ]);

        $data = $google->getData($request->search);
        if ($data['status'] == 1 && !empty($data['data']->items))
            return array_slice($data['data']->items, 0, 10);

        return array();

        /* return json_decode(json_encode(array(
          array('title' => 'asdasd', 'link' => 'www.ggogl.com', 'snippet' => 'mfjfmmfjmfjmjfm'),
          array('title' => 'asd', 'link' => 'www.ggogl.come', 'snippet' => 'mfjaaafmmfjmfjmjfm'),
          array('title' => 'as', 'link' => 'www.ggogl.comr', 'snippet' => 'mfjfmmaaafjmfjmjfm'),
          array('title' => 'ss', 'link' => 'www.ggogl.coma', 'snippet' => 'mfjfmmfjmaaafjmjfm')
          ))); */
    }

}
