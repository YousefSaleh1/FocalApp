<?php

namespace App\Http\Traits;

use App\Http\Requests\JobRequest;
use App\Http\Requests\StoreProcessRequest;
use App\Models\Bloger;
use App\Models\CompanyJob;
use App\Models\Freelancer;
use App\Models\Processe;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait CreateTrait
{
    public function CreateJob(JobRequest $request, $business_owner_id)
    {
        $job = CompanyJob::create([
            'business_owners_id' => $business_owner_id,
            'job_title'          => $request->job_title,
            'job_role'           => $request->job_role,
            'job_level'          => $request->job_level,
            'experience'         => $request->experience,
            'education_level'    => $request->education_level,
            'language'           => $request->language,
            'age_range'          => $request->age_range,
            'gender'             => $request->gender,
            'city_id'            => $request->city_id,
            'job_type'           => $request->job_type,
            'address'            => $request->address,
            'work_hour'          => $request->work_hour,
            'salary_range'       => $request->salary_range,
            'help'               => $request->help,
            'job_discription'    => $request->job_discription,
            'job_requirement'    => $request->job_requirement,
            'status'             => $request->status,
            'cancel_desc'        => $request->cancel_desc,
        ]);
        return $job;
    }

    public function CreateWallete($user_id)
    {
        $wallet = Wallet::create([
            "user_id" => $user_id,
            'current' => 0.0,
            'point'   => 0,
        ]);
        return $wallet;
    }

    public function CreateFreelancer($user_id)
    {
        $freelancer = Freelancer::create(["user_id" => $user_id]);

        $this->CreateWallete($user_id);
        return $freelancer;
    }

    public function CreateProcessePayJob($wallet, $business_owner, $amount)
    {
        $processe = Processe::Create([
            'wallet_id'           => $wallet->id,
            'contact_number'      =>  $business_owner->company_number,
            'amount'              => $amount,
            'sender_name'         => $business_owner->company_name,
            'sender_id_number'    => $business_owner->user_id,
            'payment_method'      => "Withdraw",
            'receipt_number'      => "1",
            'receiver_name'       => "Focal_X",
            'receiver_id_number'  => "1",
            'address'             => 'XXXXX',
            'password_vorifi'     => "00000000000",

        ]);
        return $processe;
    }

    public function CreateProcesse(StoreProcessRequest $request, $payment_method, $wallet_id)
    {

        $proccesse = Processe::Create([
            'wallet_id'            => $wallet_id,
            'contact_number'       => $request->contact_number,
            'amount'               => $request->amount,
            'sender_name'          => $request->sender_name,
            'sender_id_number'     => $request->sender_id_number,
            'payment_method'       => $payment_method,
            'address'              => $request->address,
            'receipt_number'       => $request->receipt_number,
            'receiver_name'        => $request->receiver_name,
            'receiver_id_number'   => $request->receiver_id_number,
            'password_vorifi'      => $request->receiver_id_number,

        ]);
        return $proccesse;
    }

    public function CreateBloger($user_id)
    {
        $bloger = Bloger::create(["user_id" => $user_id]);
        return $bloger;
    }
}
