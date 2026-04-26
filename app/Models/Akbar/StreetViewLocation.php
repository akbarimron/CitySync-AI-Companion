<?php

namespace App\Models\Akbar;

class StreetViewLocation
{
    /**
     * Demo embed URLs for Street View examples.
     *
     * @return array<int, array<string, float|string>>
     */
    public static function examples(): array
    {
        return [
            [
                'name' => 'Contoh dari tim (Bandung)',
                'embed_url' => 'https://www.google.com/maps/embed?pb=!4v1777207596927!6m8!1m7!1s5_e48QvAXYL2DIWgCEiZUQ!2m2!1d-6.861415072954376!2d107.5920601632492!3f10.85603!4f0!5f0.7820865974627469',
            ],
        ];
    }
}
