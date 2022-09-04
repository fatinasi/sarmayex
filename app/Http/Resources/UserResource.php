<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $token;

    public function __construct($resource,$token)
    {
        $this->token =$token;
        parent::__construct($resource);
    }
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'username'=> $this->name,
            'api_token'=> $this->token,
        ];
    }
    
    public function with($request){
        return [
            'status'=>'success'
        ];
    }
}
