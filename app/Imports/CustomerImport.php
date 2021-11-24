<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\HotelCustomer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CustomerImport implements ToModel, WithBatchInserts, WithHeadingRow, WithChunkReading, WithValidation, SkipsOnFailure
{
    use SkipsFailures;
    
    public function model(array $row)
    {
        $member = request()->hotel->customers()->where('email', $row['email'])->orWhere('phone', $row['phone'])->count();

        if ($member > 0) {
            return;
        }

        return (new HotelCustomer)->forceFill([
            'id' => Str::uuid()->toString(),
            'hotel_id' => request()->hotel->id,
            'surname' => $row['surname'],
            'other_names' => $row['other_names'],
            'date_of_birth' =>  $row['date_of_birth'] ? Carbon::parse($row['date_of_birth']) : null,
            'gender' => $row['gender'],
            'phone' => $row['phone'] ?? null,
            'email' => $row['email'] ?? null,
            'address' => $row['address'],
            'city' => $row['city'],
            'region' => $row['region'],
            'country' => $row['country'],
            'nationality' => $row['nationality'],
            'contact_name' => $row['emergency_contact_name'],
            'contact_phone' => $row['emergency_contact_phone'],
        ]);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function rules(): array
    {
        return [
            'surname' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'emergency_contact_phone' => [
                'nullable',
                'numeric',
            ],
            'email' => [
                'nullable',
                'email',
            ],
        ];
    }
}
