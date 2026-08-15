<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function __invoke(
        Request $request,
        string $locale
    ): RedirectResponse {
        abort_unless(
            in_array($locale, ['en', 'mk'], true),
            404
        );

        $request->session()->put(
            'locale',
            $locale
        );

        if ($request->user()) {
            $request->user()->update([
                'locale' => $locale,
            ]);
        }

        return back()->withCookie(
            cookie(
                'locale',
                $locale,
                60 * 24 * 365
            )
        );
    }
}