<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Post access|Post create|Post edit|Post delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Post create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Post edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Post delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Post= Post::paginate(4);

        return view('post.index',['posts'=>$Post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $data['user_id'] = Auth::user()->id;
        $Post = Post::create($data);
       // For the Hajira 
       $currentDate = Carbon::today();
       $formattedDate = $currentDate->format('m-d-Y');
       $booleanValue = filter_var($request->paid, FILTER_VALIDATE_BOOLEAN);
       $client = new Client();
    try {
        $response = $client->post('https://ethiohajj.com/api/pilgrim', [
            'headers' => [
                'X-Authorization' => 'GViwAFO9tyNVSEhxH5wp43n3BF1f8O4EWzHa5up3KqqzipyrAwpU5F3SYffO851n',
                'X-Authorization-Secret' => '4ygkMzQb4udXYcpGinCRfYaGK846SWsduGoPGRIY928IUUgySWbjED012qw21hsY',
            ],
            'json' => [
                'date'=>$formattedDate,
                'payment_code' => $request->payment_code,
                'bank_code'=>$request->bank_code,
                'account_holder'=> $request->account_holder,
                'account_number'=>$request->account_number,
                'amount'=>$request->amount,
                'refrence_number'=>$request->refrence_number,
                'paid'=>true
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $data = $response->getBody()->getContents();

        // Process the response data as needed


        $arrayData = json_decode($data, true);

        return view('post.new',['data'=>$arrayData]);

        //return $arrayData['pilgrim']['paid'];
    } catch (Exception $e) {
        // Handle any exceptions or errors here
    }
        return redirect()->back()->withSuccess('Updated Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       return view('post.edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->back()->withSuccess('Post updated !!!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->withSuccess('Post deleted !!!');
    }
}
