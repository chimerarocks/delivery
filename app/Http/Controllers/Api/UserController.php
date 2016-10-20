<?php

namespace Delivery\Http\Controllers\Api;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use Illuminate\Http\Request;
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

	public function updateDeviceToken(Request $request)
	{
		$id = Auth::user()->id;
		$device_token = $request->get('device_token');
		return $this->userRepository->updateDeviceToken($id, $device_token);
	}
}
