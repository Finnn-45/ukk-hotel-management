<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageSection;
use App\Models\LandingPageService;
use App\Models\LandingPageGallery;
use App\Models\LandingPageTestimonial;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $sections = LandingPageSection::orderBy('order')->get();
        $services = LandingPageService::orderBy('order')->get();
        $galleries = LandingPageGallery::orderBy('order')->get();
        $testimonials = LandingPageTestimonial::orderBy('created_at', 'desc')->get();

        return view('admin.landing-page.index', compact('sections', 'services', 'galleries', 'testimonials'));
    }

    public function updateSection(Request $request, LandingPageSection $section)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'metadata' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $section->update($request->all());

        return back()->with('success', 'Section berhasil diupdate');
    }

    public function updateService(Request $request, LandingPageService $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update($request->all());

        return back()->with('success', 'Service berhasil diupdate');
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        LandingPageService::create($request->all());

        return back()->with('success', 'Service berhasil ditambahkan');
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        LandingPageGallery::create($request->all());

        return back()->with('success', 'Gallery berhasil ditambahkan');
    }

    public function destroyService(LandingPageService $service)
    {
        $service->delete();
        return back()->with('success', 'Service berhasil dihapus');
    }

    public function destroyGallery(LandingPageGallery $gallery)
    {
        $gallery->delete();
        return back()->with('success', 'Gallery berhasil dihapus');
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'message' => 'required|string',
            'avatar' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        LandingPageTestimonial::create($request->all());

        return back()->with('success', 'Testimonial berhasil ditambahkan');
    }

    public function destroyTestimonial(LandingPageTestimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial berhasil dihapus');
    }
}