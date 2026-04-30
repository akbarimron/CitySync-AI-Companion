<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_address' => 'required|string|min:5|max:255',
            'destination_address' => 'required|string|min:5|max:255',
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'transit_type' => 'required|in:bus,train,subway,tram,car,plane',
            'avoid_tolls' => 'boolean',
            'fastest_route' => 'boolean',
            'avoid_crowds' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'current_address.required' => 'Alamat awal wajib diisi',
            'current_address.min' => 'Alamat awal minimal 5 karakter',
            'destination_address.required' => 'Alamat tujuan wajib diisi',
            'departure_date.after_or_equal' => 'Tanggal keberangkatan tidak boleh masa lalu',
            'transit_type.in' => 'Jenis transportasi tidak valid'
        ];
    }
}
