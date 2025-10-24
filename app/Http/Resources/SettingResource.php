<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'app_name' => $this->getCurrentNameLangAttribute(),
            'subscription_title' => $this->subscription_title,
            'address' => $this->address,
            'email' => $this->email,
            'image' => asset('storage/' . $this->image),
            'logo' => asset('storage/' . $this->logo),
        ];
    }
}
