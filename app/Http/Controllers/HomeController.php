<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\GithubRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getCommits(Request $request, GithubRepository $githubRepository)
    {
        $userNameList = explode(',', $request->post('usernames'));
        $commitsByUsers = $githubRepository->getCommitsForUsers($userNameList);
        return view('github-commits')->with(array('commitsByUsers' => $commitsByUsers))->render();
    }


}
