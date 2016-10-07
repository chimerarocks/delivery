<?php

namespace Http\Controllers\Api;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	private $userRepository;

	public function __construct(
		UserRepository $userRepository
		)
	{
		$this->userRepository = $userRepository;
	}

	public function authenticated()
	{
		return $this->userRepository->skipPresenter(false)->find(Auth::user()->id);
	}
}
