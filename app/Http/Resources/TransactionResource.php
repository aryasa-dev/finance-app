<?php
namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'amount'           => $this->amount,
            'type'             => $this->type,
            'description'      => $this->description,
            'transaction_date' => (new Carbon($this->transaction_date))->format('Y-m-d'),
            'category'         => new CategoryResource($this->category),
        ];
    }
}
