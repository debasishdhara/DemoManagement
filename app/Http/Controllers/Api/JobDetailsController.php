<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JobDetailsController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function jobDetails(Request $request){
        // return response()->json(["req"=>$request->all()]);
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'user_not_found',
                    "isSuccess" => false
                ]], 404);
            }else{
                $userId = auth()->user()->id;
                $data = [
                    'user_id' => $userId,
                    'course_check' => $request->all_course?2:1,
                    'category' => $request->categoryCtrl?(int)$request->categoryCtrl:null,
                    'education' => $request->educationCtrl?(int)$request->educationCtrl:null,
                    'gender' => $request->genderCtrl?(int)$request->genderCtrl:null,
                    'interview_date' => $request->interviewDateCtrl?Carbon::createFromFormat('Y-m-d',$request->interviewDateCtrl)->format("Y-m-d"):null,
                    'job_description' => $request->jobDescriptionCtrl?$request->jobDescriptionCtrl:null,
                    'job_location' => $request->joblocationCtrl?$request->joblocationCtrl:null,
                    'job_title' => $request->jobtitleCtrl?$request->jobtitleCtrl:null,
                    'maxage' => $request->maxageCtrl?$request->maxageCtrl:null,
                    'minage' => $request->minageCtrl?$request->minageCtrl:null,
                    'minexp' => $request->minexpCtrl?$request->minexpCtrl:null,
                    'opening_number' => $request->noOfOpeningCtrl?$request->noOfOpeningCtrl:null,
                    'organizationname' => $request->organizationnameCtrl?$request->organizationnameCtrl:null,
                    'percentage' => $request->percentageCtrl?$request->percentageCtrl:null,
                    'physicalcheck' => $request->physicalcheckCtrl?(int)$request->physicalcheckCtrl:null,
                    'position' => $request->positionCtrl?$request->positionCtrl:null,
                    'salary_range' => $request->salaryRangeCtrl?(int)$request->salaryRangeCtrl:null,
                    'servicetirm' => $request->servicetirmCtrl?$request->servicetirmCtrl:null,
                    'url' => $request->urlCtrl?$request->urlCtrl:null,
                ];

                return response()->json([
                    "serverResponse" => [
                    "code" => 200,
                    "message" => 'Request All',
                    "isSuccess" => true
                    ],
                    "result"=>$data
                ]);
            }
        } catch (TokenExpiredException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_expired',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_invalid',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        } catch (JWTException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_absent',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        }
        return response()->json([
            "serverResponse" => [
                "code" => 401,
                "message" => "User Details Not Found",
                "isSuccess" => false
            ]
            ]);
    }
}
