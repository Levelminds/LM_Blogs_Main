<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    public function edit()
    {
        $settings = SeoSetting::current();

        return view('admin.seo.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SeoSetting::current();

        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'title_suffix' => 'nullable|string|max:255',
            'default_description' => 'nullable|string|max:500',
            'default_keywords' => 'nullable|string|max:500',
            'twitter_handle' => 'nullable|string|max:50',
            'facebook_app_id' => 'nullable|string|max:100',
            'index_site' => 'sometimes|boolean',
            'default_og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('default_og_image')) {
            if ($settings->default_og_image && Storage::disk('public')->exists($settings->default_og_image)) {
                Storage::disk('public')->delete($settings->default_og_image);
            }

            $validated['default_og_image'] = $request->file('default_og_image')->store('seo', 'public');
        }

        $validated['index_site'] = $request->boolean('index_site');

        $settings->fill($validated)->save();

        SeoSetting::forgetCache();

        return redirect()
            ->route('admin.seo.edit')
            ->with('success', 'SEO settings updated successfully.');
    }
}
