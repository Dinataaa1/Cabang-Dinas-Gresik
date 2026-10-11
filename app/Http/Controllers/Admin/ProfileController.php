<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $about         = Profile::where('key', 'about')->first();
        $visiMisi      = Profile::where('key', 'visi_misi')->first();
        $struktur      = Profile::where('key', 'struktur')->first();
        $sambutanNama  = Profile::where('key', 'sambutan_nama')->first();
        $sambutanTitle = Profile::where('key', 'sambutan_title')->first();
        $sambutanTeks  = Profile::where('key', 'sambutan_text')->first();
        $sambutanFoto  = Profile::where('key', 'sambutan_image')->first();
        $sideSlider1   = Profile::where('key', 'side_slider_1')->first();
        $sideSlider2   = Profile::where('key', 'side_slider_2')->first();
        $quoteSlide1   = Profile::where('key', 'quote_slide_1')->first();
        $quoteSlide2   = Profile::where('key', 'quote_slide_2')->first();
        $quoteSlide3   = Profile::where('key', 'quote_slide_3')->first();

                $org1 = Profile::where('key', 'org_person_1')->first();
        $org2 = Profile::where('key', 'org_person_2')->first();
        $org3 = Profile::where('key', 'org_person_3')->first();
        $org4 = Profile::where('key', 'org_person_4')->first();

        return view('admin.profile.index', compact(
            'about', 'visiMisi', 'struktur', 
            'sambutanNama', 'sambutanTitle', 'sambutanTeks', 'sambutanFoto',
            'sideSlider1', 'sideSlider2', 'quoteSlide1', 'quoteSlide2', 'quoteSlide3',
            'org1', 'org2', 'org3', 'org4'
        ));

        return view('admin.profile.index', compact(
            'about', 'visiMisi', 'struktur', 
            'sambutanNama', 'sambutanTitle', 'sambutanTeks', 'sambutanFoto',
            'sideSlider1', 'sideSlider2', 'quoteSlide1', 'quoteSlide2', 'quoteSlide3'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_content'     => 'required|string',
            'about_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'visi_misi_content' => 'required|string',
            'struktur_content'  => 'nullable|string',
            'struktur_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            
            // New validation rules
            'sambutan_nama'     => 'required|string|max:255',
            'sambutan_title'    => 'required|string|max:255',
            'sambutan_text'     => 'required|string',
            'sambutan_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            
            'side_slider_1'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'side_slider_2'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            
            'qs_image_1'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'qs_badge_icon_1'   => 'nullable|string|max:50',
            'qs_badge_text_1'   => 'nullable|string|max:100',
            'qs_quote_1'        => 'nullable|string',
            'qs_author_1'       => 'nullable|string|max:255',
            'qs_title_1'        => 'nullable|string|max:255',

            'qs_image_2'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'qs_badge_icon_2'   => 'nullable|string|max:50',
            'qs_badge_text_2'   => 'nullable|string|max:100',
            'qs_quote_2'        => 'nullable|string',
            'qs_author_2'       => 'nullable|string|max:255',
            'qs_title_2'        => 'nullable|string|max:255',

            'qs_image_3'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'qs_badge_icon_3'   => 'nullable|string|max:50',
            'qs_badge_text_3'   => 'nullable|string|max:100',
            'qs_quote_3'        => 'nullable|string',
            'qs_author_3'       => 'nullable|string|max:255',
            'qs_title_3'        => 'nullable|string|max:255',

                        'org_image_1'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'org_name_1'        => 'nullable|string|max:255',
            'org_position_1'    => 'nullable|string|max:255',
            'org_nip_1'         => 'nullable|string|max:100',

            'org_image_2'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'org_name_2'        => 'nullable|string|max:255',
            'org_position_2'    => 'nullable|string|max:255',
            'org_nip_2'         => 'nullable|string|max:100',

            'org_image_3'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'org_name_3'        => 'nullable|string|max:255',
            'org_position_3'    => 'nullable|string|max:255',
            'org_nip_3'         => 'nullable|string|max:100',

            'org_image_4'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'org_name_4'        => 'nullable|string|max:255',
            'org_position_4'    => 'nullable|string|max:255',
            'org_nip_4'         => 'nullable|string|max:100',
        ]);

        // Helper: sanitize HTML using mews/purifier if available
        $sanitizeHtml = function ($html) {
            if (app()->bound('purifier')) {
                try {
                    return app('purifier')->clean($html);
                } catch (\Throwable $e) {
                    return $html;
                }
            }
            return $html;
        };

        // ── Update About (with optional image) ──────────────────────────────
        $about = Profile::where('key', 'about')->first();
        $aboutImagePath = $about ? $about->image : null;

        if ($request->hasFile('about_image')) {
            if ($about && $about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $aboutImagePath = $request->file('about_image')->store('profiles', 'public');
        }

        Profile::updateOrCreate(
            ['key' => 'about'],
            ['content' => $sanitizeHtml($request->about_content), 'image' => $aboutImagePath]
        );

        // ── Update Visi Misi ─────────────────────────────────────────────────
        Profile::updateOrCreate(
            ['key' => 'visi_misi'],
            ['content' => $sanitizeHtml($request->visi_misi_content)]
        );

        // ── Update Struktur Organisasi ───────────────────────────────────────
        $struktur = Profile::where('key', 'struktur')->first();
        $strukturImagePath = $struktur ? $struktur->image : null;

        if ($request->hasFile('struktur_image')) {
            if ($struktur && $struktur->image) {
                Storage::disk('public')->delete($struktur->image);
            }
            $strukturImagePath = $request->file('struktur_image')->store('profiles', 'public');
        }

        Profile::updateOrCreate(
            ['key' => 'struktur'],
            [
                'content' => $sanitizeHtml($request->struktur_content),
                'image'   => $strukturImagePath,
            ]
        );

        // ── Update Sambutan Nama ─────────────────────────────────────────────
        Profile::updateOrCreate(
            ['key' => 'sambutan_nama'],
            ['content' => $request->sambutan_nama]
        );

        // ── Update Sambutan Title ────────────────────────────────────────────
        Profile::updateOrCreate(
            ['key' => 'sambutan_title'],
            ['content' => $request->sambutan_title]
        );

        // ── Update Sambutan Text (sanitize to plain text) ─────────────────────
        Profile::updateOrCreate(
            ['key' => 'sambutan_text'],
            ['content' => $sanitizeHtml($request->sambutan_text)]
        );

        // ── Update Sambutan Foto ─────────────────────────────────────────────
        $sambutanFoto = Profile::where('key', 'sambutan_image')->first();
        $sambutanFotoPath = $sambutanFoto ? $sambutanFoto->image : null;

        if ($request->hasFile('sambutan_image')) {
            if ($sambutanFoto && $sambutanFoto->image) {
                Storage::disk('public')->delete($sambutanFoto->image);
            }
            $sambutanFotoPath = $request->file('sambutan_image')->store('profiles', 'public');
        }

        if ($request->hasFile('sambutan_image') || $sambutanFotoPath) {
            Profile::updateOrCreate(
                ['key' => 'sambutan_image'],
                ['image' => $sambutanFotoPath]
            );
        }

        // ── Update Side Slider 1 ─────────────────────────────────────────────
        $sideSlider1 = Profile::where('key', 'side_slider_1')->first();
        $sideSlider1Path = $sideSlider1 ? $sideSlider1->image : null;

        if ($request->hasFile('side_slider_1')) {
            if ($sideSlider1 && $sideSlider1->image) {
                Storage::disk('public')->delete($sideSlider1->image);
            }
            $sideSlider1Path = $request->file('side_slider_1')->store('profiles', 'public');
        }

        if ($request->hasFile('side_slider_1') || $sideSlider1Path) {
            Profile::updateOrCreate(
                ['key' => 'side_slider_1'],
                ['image' => $sideSlider1Path]
            );
        }

        // ── Update Side Slider 2 ─────────────────────────────────────────────
        $sideSlider2 = Profile::where('key', 'side_slider_2')->first();
        $sideSlider2Path = $sideSlider2 ? $sideSlider2->image : null;

        if ($request->hasFile('side_slider_2')) {
            if ($sideSlider2 && $sideSlider2->image) {
                Storage::disk('public')->delete($sideSlider2->image);
            }
            $sideSlider2Path = $request->file('side_slider_2')->store('profiles', 'public');
        }

        if ($request->hasFile('side_slider_2') || $sideSlider2Path) {
            Profile::updateOrCreate(
                ['key' => 'side_slider_2'],
                ['image' => $sideSlider2Path]
            );
        }

        // ── Update Quotes Slider ─────────────────────────────────────────────
        for ($i = 1; $i <= 3; $i++) {
            $qsKey = 'quote_slide_' . $i;
            $qsProfile = Profile::where('key', $qsKey)->first();
            $qsImagePath = $qsProfile ? $qsProfile->image : null;

            if ($request->hasFile('qs_image_' . $i)) {
                if ($qsProfile && $qsProfile->image) {
                    Storage::disk('public')->delete($qsProfile->image);
                }
                $qsImagePath = $request->file('qs_image_' . $i)->store('profiles', 'public');
            }

            $contentData = [
                'badge_icon' => $request->input('qs_badge_icon_' . $i),
                'badge_text' => $request->input('qs_badge_text_' . $i),
                'quote'      => $request->input('qs_quote_' . $i),
                'author_name'=> $request->input('qs_author_' . $i),
                'author_title'=> $request->input('qs_title_' . $i),
            ];

            // Save only if any field is filled or image exists
            if (array_filter($contentData) || $qsImagePath) {
                Profile::updateOrCreate(
                    ['key' => $qsKey],
                    [
                        'content' => json_encode($contentData),
                        'image'   => $qsImagePath
                    ]
                );
            }
        }

                // ── Update Org Persons ───────────────────────────────────────────────
        for ($i = 1; $i <= 4; $i++) {
            $orgKey = 'org_person_' . $i;
            $orgProfile = Profile::where('key', $orgKey)->first();
            $orgImagePath = $orgProfile ? $orgProfile->image : null;

            if ($request->hasFile('org_image_' . $i)) {
                if ($orgProfile && $orgProfile->image) {
                    Storage::disk('public')->delete($orgProfile->image);
                }
                $orgImagePath = $request->file('org_image_' . $i)->store('profiles', 'public');
            }

            $orgData = [
                'name'     => $request->input('org_name_' . $i),
                'position' => $request->input('org_position_' . $i),
                'nip'      => $request->input('org_nip_' . $i),
            ];

            // Save only if any field is filled or image exists
            if (array_filter($orgData) || $orgImagePath) {
                Profile::updateOrCreate(
                    ['key' => $orgKey],
                    [
                        'content' => json_encode($orgData),
                        'image'   => $orgImagePath
                    ]
                );
            }
        }


        return redirect()->route('admin.profile.index')
                         ->with('success', 'Profil lembaga berhasil diperbarui.');
    }
}
